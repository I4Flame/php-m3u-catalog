<?php
// lib/EPGParser.php
class EPGParser {
    private $url;
    public function __construct(string $url) {
        $this->url = $url;
    }
    public function getPrograms(): array {
        $data = $this->fetch();
        $xml = simplexml_load_string($data);
        if (!$xml) {
            return [];
        }
        $programs = [];
        foreach ($xml->programme as $programme) {
            $programs[] = [
                'channel' => (string)$programme['channel'],
                'start' => $this->parseDateTime((string)$programme['start']),
                'stop' => $this->parseDateTime((string)$programme['stop']),
                'title' => (string)$programme->title,
                'desc' => (string)$programme->desc ?? ''
            ];
        }
        return $programs;
    }
    private function fetch(): string {
        $context = stream_context_create([
            'http' => [
                'timeout' => 30,
                'user_agent' => 'EPG Parser/1.0'
            ]
        ]);
        $data = file_get_contents($this->url, false, $context);
        if ($data === false) {
            throw new Exception('EPG dosyası yüklenemedi: ' . $this->url);
        }
        return $data;
    }
    private function parseDateTime(string $dateTime): string {
        // XMLTV format: YYYYMMDDHHMMSS +ZZZZ
        if (preg_match('/(\d{14})\s*([+-]\d{4})?/', $dateTime, $matches)) {
            $dt = DateTime::createFromFormat('YmdHis', $matches[1]);
            if ($dt) {
                return $dt->format('Y-m-d H:i:s');
            }
        }
        return $dateTime;
    }
}