<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\ArchiveCategory;
use App\Models\ArchiveCategoryForm;
use App\Models\Archive;
use App\Models\ArchiveDescription;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        ArchiveCategory::create(
            [
                "name" => "Surat Masuk"
            ]
        );

        ArchiveCategoryForm::create(
            [
                "category_id" => 1,
                "name" => "Tanggal"
            ]
        );

        ArchiveCategoryForm::create(
            [
                "category_id" => 1,
                "name" => "Nomor Surat"
            ]
        );

        ArchiveCategoryForm::create(
            [
                "category_id" => 1,
                "name" => "Dari"
            ]
        );

        ArchiveCategoryForm::create(
            [
                "category_id" => 1,
                "name" => "Perihal"
            ]
        );

        ArchiveCategoryForm::create(
            [
                "category_id" => 1,
                "name" => "Nomor Agenda"
            ]
        );

        ArchiveCategoryForm::create(
            [
                "category_id" => 1,
                "name" => "Kategori"
            ]
        );

        Archive::create(
            [
                "name" => "Surat 1",
                "file_name" => "surat1.pdf",
                "category_id" => 1
            ]
        );

        ArchiveDescription::create(
            [
                "archive_id" => 1,
                "archive_form_id" => 1,
                "description" => "20 Mei 2021"
            ]
        );

        ArchiveDescription::create(
            [
                "archive_id" => 1,
                "archive_form_id" => 2,
                "description" => "1/ABC/M-21"
            ]
        );

        ArchiveDescription::create(
            [
                "archive_id" => 1,
                "archive_form_id" => 3,
                "description" => "Pihak A"
            ]
        );

        ArchiveDescription::create(
            [
                "archive_id" => 1,
                "archive_form_id" => 4,
                "description" => "Surat A"
            ]
        );
        
        ArchiveDescription::create(
            [
                "archive_id" => 1,
                "archive_form_id" => 5,
                "description" => "123"
            ]
        );

        ArchiveDescription::create(
            [
                "archive_id" => 1,
                "archive_form_id" => 6,
                "description" => "Surat Penting"
            ]
        );

    }
}
