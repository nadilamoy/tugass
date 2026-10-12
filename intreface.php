<?php

// 1. Membuat Interface
interface MetodePembayaran
{
    public function prosesBayar(float $jumlah, string $keterangan): bool;
    public function getNamaMetode(): string;
}

// 2. Class TransferBank
class TransferBank implements MetodePembayaran
{
    private $nomorRekening;

    public function __construct(string $nomorRekening)
    {
        $this->nomorRekening = $nomorRekening;
    }

    public function prosesBayar(float $jumlah, string $keterangan): bool
    {
        $admin = 0;
        $total = $jumlah + $admin;

        echo "Metode Pembayaran: " . $this->getNamaMetode() . "\n";
        echo "Nomor Rekening: " . $this->nomorRekening . "\n";
        echo "Keterangan: " . $keterangan . "\n";
        echo "Jumlah Pembayaran: Rp " . number_format($jumlah, 0, ',', '.') . "\n";
        echo "Biaya Admin: Rp " . number_format($admin, 0, ',', '.') . "\n";
        echo "Total Pembayaran: Rp " . number_format($total, 0, ',', '.') . "\n\n";

        return true;
    }

    public function getNamaMetode(): string
    {
        return "Transfer Bank";
    }
}

// 3. Class QRIS
class QRIS implements MetodePembayaran
{
    public function prosesBayar(float $jumlah, string $keterangan): bool
    {
        $admin = $jumlah * 0.007;
        $total = $jumlah + $admin;

        echo "Metode Pembayaran: " . $this->getNamaMetode() . "\n";
        echo "Keterangan: " . $keterangan . "\n";
        echo "Jumlah Pembayaran: Rp " . number_format($jumlah, 0, ',', '.') . "\n";
        echo "Biaya Admin (0.7%): Rp " . number_format($admin, 0, ',', '.') . "\n";
        echo "Total Pembayaran: Rp " . number_format($total, 0, ',', '.') . "\n\n";

        return true;
    }

    public function getNamaMetode(): string
    {
        return "QRIS";
    }
}

// 4. Class KartuKredit
class KartuKredit implements MetodePembayaran
{
    private $nomorKartu;

    public function __construct(string $nomorKartu)
    {
        $this->nomorKartu = $nomorKartu;
    }

    public function prosesBayar(float $jumlah, string $keterangan): bool
    {
        $admin = $jumlah * 0.025;
        $total = $jumlah + $admin;
        $empatDigitTerakhir = substr($this->nomorKartu, -4);

        echo "Metode Pembayaran: " . $this->getNamaMetode() . "\n";
        echo "Nomor Kartu: **** **** **** " . $empatDigitTerakhir . "\n";
        echo "Keterangan: " . $keterangan . "\n";
        echo "Jumlah Pembayaran: Rp " . number_format($jumlah, 0, ',', '.') . "\n";
        echo "Biaya Admin (2.5%): Rp " . number_format($admin, 0, ',', '.') . "\n";
        echo "Total Pembayaran: Rp " . number_format($total, 0, ',', '.') . "\n\n";

        return true;
    }

    public function getNamaMetode(): string
    {
        return "Kartu Kredit";
    }
}

// 5. Eksekusi Program
$transfer = new TransferBank("1234567890");
$qris = new QRIS();
$kartuKredit = new KartuKredit("1234567812345678");

$transfer->prosesBayar(500000, "Pembelian barang");
$qris->prosesBayar(500000, "Pembelian barang");
$kartuKredit->prosesBayar(500000, "Pembelian barang");

?>