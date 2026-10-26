<?php
/** Contenido mensual y anual de la agenda institucional. */
class Agenda {
    public const MONTHS = [
        1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
        5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
        9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre',
    ];

    public static function all(int $year): array {
        global $conn;
        $stmt = $conn->prepare('SELECT * FROM agenda_months WHERE year = ? ORDER BY month_number ASC');
        if (!$stmt) return [];
        $stmt->bind_param('i', $year);
        if (!$stmt->execute()) return [];
        $result = $stmt->get_result();
        $entries = [];
        while ($row = $result->fetch_assoc()) $entries[(int)$row['month_number']] = $row;
        $stmt->close();
        return $entries;
    }

    public static function years(): array {
        global $conn;
        $result = $conn->query('SELECT DISTINCT year FROM agenda_months ORDER BY year DESC');
        $years = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) $years[] = (int) $row['year'];
        }
        return $years;
    }

    public static function save(int $year, int $month, string $title, string $subtitle, string $textOne, string $textTwo): bool {
        global $conn;
        $stmt = $conn->prepare(
            'INSERT INTO agenda_months (year, month_number, title, subtitle, text_one, text_two) VALUES (?, ?, ?, ?, ?, ?) '
            . 'ON DUPLICATE KEY UPDATE title = VALUES(title), subtitle = VALUES(subtitle), text_one = VALUES(text_one), text_two = VALUES(text_two)'
        );
        if (!$stmt) return false;
        $stmt->bind_param('iissss', $year, $month, $title, $subtitle, $textOne, $textTwo);
        $saved = $stmt->execute();
        $stmt->close();
        return $saved;
    }

    /** Allow only basic formatting elements created by the admin editor. */
    public static function renderFormatted(string $html): string {
        $html = trim($html);
        if ($html === '') return '';

        $previous = libxml_use_internal_errors(true);
        $document = new DOMDocument('1.0', 'UTF-8');
        $document->loadHTML('<?xml encoding="UTF-8"><div id="agenda-content">' . $html . '</div>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $root = $document->getElementById('agenda-content');
        if (!$root) {
            libxml_clear_errors();
            libxml_use_internal_errors($previous);
            return nl2br(htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'));
        }

        self::cleanNode($root);
        $output = '';
        foreach ($root->childNodes as $child) $output .= $document->saveHTML($child);
        libxml_clear_errors();
        libxml_use_internal_errors($previous);
        return $output;
    }

    private static function cleanNode(DOMNode $node): void {
        $allowed = ['p', 'br', 'strong', 'b', 'ul', 'ol', 'li'];
        for ($child = $node->firstChild; $child !== null;) {
            $next = $child->nextSibling;
            if ($child instanceof DOMElement) {
                self::cleanNode($child);
                if (!in_array(strtolower($child->tagName), $allowed, true)) {
                    $parent = $child->parentNode;
                    while ($child->firstChild) $parent->insertBefore($child->firstChild, $child);
                    $parent->removeChild($child);
                } else {
                    while ($child->attributes->length > 0) $child->removeAttributeNode($child->attributes->item(0));
                }
            } elseif (!($child instanceof DOMText)) {
                $node->removeChild($child);
            }
            $child = $next;
        }
    }
}
