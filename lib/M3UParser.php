<?php
// lib/M3UParser.php
class M3UParser {
    private $url;
    private $excludeTypes;
    public function __construct(string $url, array $excludeTypes = []) {
        $this->url = $url;
        $this->excludeTypes = $excludeTypes;
    }
    public function getItems(): array {
        $data = $this->fetch();
        $lines = preg_split('/\r?\n/', $data);
        $items = [];
        $current = [];
        foreach ($lines as $line) {
            if (strpos($line, '#EXTINF:') === 0) {
                // parse attributes
                preg_match('/#EXTINF:-?\d+(.*),(.*)/', $line, $matches);
                $attrString = $matches[1] ?? '';
                $title = $matches[2] ?? '';
                // skip excluded types
                foreach ($this->excludeTypes as $type) {
                    if (stripos($line, $type) !== false) {
                        $current = [];
                        continue 2;
                    }
                }
                // extract group-title
                $group = 'Unknown';
                if (preg_match('/group-title="([^"]+)"/', $attrString, $groupMatches)) {
                    $group = $groupMatches[1];
                }
                $current = [
                    'title' => trim($title),
                    'group' => trim($group),
                ];
            } elseif (!empty($line) && !empty($current) && strpos($line, '#') !== 0) {
                // URL line
                $current['url'] = trim($line);
                $items[] = $current;
                $current = [];
            }
        }
        return $items;
    }
    public function getItemsByCategory(string $category): array {
        $items = $this->getItems();
        return array_filter($items, function($item) use ($category) {
            return $item['group'] === $category;
        });
    }
    private function fetch(): string {
        $context = stream_context_create([
            'http' => [
                'timeout' => 30,
                'user_agent' => 'M3U Parser/1.0'
            ]
        ]);
        $data = file_get_contents($this->url, false, $context);
        if ($data === false) {
            throw new Exception('M3U dosyası yüklenemedi: ' . $this->url);
        }
        return $data;
    }
}