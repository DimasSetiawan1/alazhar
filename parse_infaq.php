<?php

$html = file_get_contents('d:/Joki/jahra pengasinan/Infaq _ Masjid AL - Azhar.html');
$dom = new DOMDocument();
@$dom->loadHTML($html);

$xpath = new DOMXPath($dom);
$rows = $xpath->query('//div[@id="infaq"]//tbody/tr');

$infaqData = [];
foreach ($rows as $row) {
    $cols = $row->getElementsByTagName('td');
    if ($cols->length >= 3) {
        $oleh = trim($cols->item(0)->textContent);
        $jumlahStr = trim($cols->item(1)->textContent);
        $tanggal = trim($cols->item(2)->textContent);
        
        // Clean up jumlah: "Rp. 1,838,000" -> 1838000
        $jumlah = preg_replace('/[^0-9]/', '', $jumlahStr);
        
        if ($oleh && $jumlah && $tanggal) {
            $infaqData[] = [
                'nama_donatur' => addslashes($oleh),
                'jumlah' => (int) $jumlah,
                'tanggal' => addslashes($tanggal),
                'status' => 'confirmed'
            ];
        }
    }
}

$output = "        \$infaqData = [\n";
foreach ($infaqData as $data) {
    $output .= "            ['nama_donatur' => '{$data['nama_donatur']}', 'jumlah' => {$data['jumlah']}, 'tanggal' => '{$data['tanggal']}', 'status' => '{$data['status']}'],\n";
}
$output .= "        ];\n";

file_put_contents('infaq_array.txt', $output);
echo "Extracted " . count($infaqData) . " records.\n";

