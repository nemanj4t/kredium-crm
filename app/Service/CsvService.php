<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\StreamedResponse;

class CsvService
{
    public function export(string $fileName, array $data): StreamedResponse
    {
        $response = new StreamedResponse(static function () use ($data) {
            $handle = fopen('php://output', 'w');

            foreach ($data as $row) {
                fputcsv($handle, $row);
            }

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $fileName . '"');

        return $response;
    }
}
