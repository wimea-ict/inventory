<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once('vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\IOFactory;

class Reports_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function make_items_report() {
        $headers = ['Item', 'Category', 'Since', 'Number In', 'Number Out'];

        $items = $this->items_model->get_items();

        $data = [];
        foreach ($items as $item) {
            $data[] = [
                ucwords($item['name']),
                $item['category_name'],
                (new DateTime($item['date_entered']))->format('F jS, Y'),
                $item['number_in'],
                $item['number_out']
            ];
        }

        $file = $this->make_report('items-report', $headers, $data);
        return $file;
    }

    public function make_batches_report() {
        $headers = ['Batch', 'Item', 'Quantity', 'Date Brought'];

        $batches = $this->transactions_model->get_new_batches();

        $data = [];
        foreach ($batches as $batch) {
            foreach ($batch['items'] as $item) {
                $data[] = [
                    $batch['id'],
                    ucwords($item['name']),
                    $item['quantity'],
                    (new DateTime($batch['date_brought']))->format('F jS, Y')
                ];
            }
        }

        $file = $this->make_report('batches-report', $headers, $data);
        return $file;
    }

    public function make_items_returned_report() {
        $headers = ['Item', 'Quantity', 'Receiver Name', 'Contacts', 'Comments', 'Date Returned'];

        $transactions = $this->transactions_model->get_items_returned();

        $data = [];
        foreach ($transactions as $transaction) {
            foreach ($transaction['items'] as $item) {
                $data[] = [
                    ucwords($item['name']),
                    $item['quantity'],
                    ucwords($transaction['name']),
                    $transaction['contacts'],
                    ucfirst($transaction['comments']),
                    (new DateTime($transaction['date_returned']))->format('F jS, Y')
                ];
            }
        }

        $file = $this->make_report('items-returned-report', $headers, $data);
        return $file;
    }

    public function make_items_given_out_report() {
        $headers = ['Item', 'Quantity', 'Receiver Name', 'Contacts', 'Comments', 'Date Given'];

        $transactions = $this->transactions_model->get_items_given_out('pending');

        $data = [];
        foreach ($transactions as $transaction) {
            foreach ($transaction['items'] as $item) {
                $data[] = [
                    ucwords($item['name']),
                    $item['quantity'],
                    ucwords($transaction['name']),
                    $transaction['contacts'],
                    ucfirst($transaction['comments']),
                    (new DateTime($transaction['date_returned']))->format('F jS, Y')
                ];
            }
        }

        $file = $this->make_report('items-given-out-report', $headers, $data);
        return $file;
    }

    private function make_report($report, $headers, $data) {
        $filename = "/tmp/{$report}.csv";

        // Open the file.
        $file = fopen($filename, 'w');

        // Save the column headers.
        fputcsv($file, $headers);

        // Save each row of the data.
        foreach ($data as $row) {
            fputcsv($file, $row);
        }

        // Close the file.
        fclose($file);

        $reader = IOFactory::createReader('Csv')->setDelimiter(',')->setSheetIndex(0);
        $spreadsheetFromCSV = $reader->load($filename);

        // Write Xlsx
        $filename = "/tmp/{$report}.xlsx";
        $writerExcel = IOFactory::createWriter($spreadsheetFromCSV, 'Xlsx');
        $writerExcel->save($filename);

        return $filename;
    }
}
?>