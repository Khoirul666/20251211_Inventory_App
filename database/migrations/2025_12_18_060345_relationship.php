<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('barangs', function (Blueprint $table) {
            // 1. Tambahkan kolom foreign key
            $table->foreignId('id_kategori')
                ->after('id_barang') // Letakkan setelah Primary Key   // Gunakan nullable jika tabel sudah ada isinya
                ->references('id_kategori')
                ->on('kategoris') // Merujuk ke tabel kategoris
                ->onDelete('cascade');     // Jika kategori dihapus, barang ikut terhapus
        });

        Schema::table('barang_masuks', function (Blueprint $table) {
            // 1. Tambahkan kolom foreign key
            $table->foreignId('id_supplier')
                ->after('id_barangmasuk') // Letakkan setelah Primary Key     // Gunakan nullable jika tabel sudah ada isinya
                ->references('id_supplier')
                ->on('suppliers') // Merujuk ke tabel kategoris
                ->onDelete('cascade');     // Jika kategori dihapus, barang ikut terhapus
            // 1. Tambahkan kolom foreign key
            $table->foreignId('id_barang')
                ->after('id_supplier') // Letakkan setelah Primary Key     // Gunakan nullable jika tabel sudah ada isinya
                ->references('id_barang')
                ->on('barangs') // Merujuk ke tabel kategoris
                ->onDelete('cascade');     // Jika kategori dihapus, barang ikut terhapus

        });

        Schema::table('invoice_pembelians', function (Blueprint $table) {
            // 1. Tambahkan kolom foreign key
            $table->foreignId('id_barangmasuk')
                ->after('id_invoicepembelian') // Letakkan setelah Primary Key   // Gunakan nullable jika tabel sudah ada isinya
                ->references('id_barangmasuk')
                ->on('barang_masuks') // Merujuk ke tabel kategoris
                ->onDelete('cascade');     // Jika kategori dihapus, barang ikut terhapus
        });

        Schema::table('barang_keluars', function (Blueprint $table) {
            // 1. Tambahkan kolom foreign key
            $table->foreignId('id_customer')
                ->after('id_barangkeluar') // Letakkan setelah Primary Key     // Gunakan nullable jika tabel sudah ada isinya
                ->references('id_customer')
                ->on('customers') // Merujuk ke tabel kategoris
                ->onDelete('cascade');     // Jika kategori dihapus, barang ikut terhapus
            // 1. Tambahkan kolom foreign key
            $table->foreignId('id_barang')
                ->after('id_customer') // Letakkan setelah Primary Key     // Gunakan nullable jika tabel sudah ada isinya
                ->references('id_barang')
                ->on('barangs') // Merujuk ke tabel kategoris
                ->onDelete('cascade');     // Jika kategori dihapus, barang ikut terhapus

        });

        Schema::table('invoice_penjualans', function (Blueprint $table) {
            // 1. Tambahkan kolom foreign key
            $table->foreignId('id_barangkeluar')
                ->after('id_invoicepenjualan') // Letakkan setelah Primary Key   // Gunakan nullable jika tabel sudah ada isinya
                ->references('id_barangkeluar')
                ->on('barang_keluars') // Merujuk ke tabel kategoris
                ->onDelete('cascade');     // Jika kategori dihapus, barang ikut terhapus
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('barangs', function (Blueprint $table) {
            // 2. Hapus relasi dan kolomnya jika di-rollback
            $table->dropForeign(['id_kategori']);
            $table->dropColumn('id_kategori');
        });
        Schema::table('barang_masuks', function (Blueprint $table) {
            // 2. Hapus relasi dan kolomnya jika di-rollback
            $table->dropForeign(['id_supplier']);
            $table->dropColumn('id_supplier');
            $table->dropForeign(['id_barang']);
            $table->dropColumn('id_barang');
        });
        Schema::table('invoice_pembelians', function (Blueprint $table) {
            // 2. Hapus relasi dan kolomnya jika di-rollback
            $table->dropForeign(['id_barangmasuk']);
            $table->dropColumn('id_barangmasuk');
        });
        Schema::table('barang_keluars', function (Blueprint $table) {
            // 2. Hapus relasi dan kolomnya jika di-rollback
            $table->dropForeign(['id_customer']);
            $table->dropColumn('id_customer');
            $table->dropForeign(['id_barang']);
            $table->dropColumn('id_barang');
        });
        Schema::table('invoice_penjualans', function (Blueprint $table) {
            // 2. Hapus relasi dan kolomnya jika di-rollback
            $table->dropForeign(['id_barangkeluar']);
            $table->dropColumn('id_barangkeluar');
        });
    }
};
