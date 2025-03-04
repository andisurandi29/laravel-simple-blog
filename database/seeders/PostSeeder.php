<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('posts')->insert([
            // Active posts
            [
                'title' => 'Belajar Laravel dari Nol',
                'content' => 'Laravel adalah framework PHP yang sangat powerful...',
                'publish_date' => Carbon::now(),
                'status' => 'Active',
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Mengenal Blade Templating',
                'content' => 'Blade adalah template engine bawaan Laravel...',
                'publish_date' => Carbon::now(),
                'status' => 'Active',
                'user_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Memahami Route dan Controller',
                'content' => 'Routing di Laravel bisa dibuat menggunakan Closure atau Controller...',
                'publish_date' => Carbon::now(),
                'status' => 'Active',
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Mengenal Laravel Sanctum',
                'content' => 'Laravel Sanctum adalah package untuk autentikasi API di Laravel...',
                'publish_date' => Carbon::now(),
                'status' => 'Active',
                'user_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            
            // Schedule posts
            [
                'title' => 'Cara Install Laravel di Windows',
                'content' => 'Untuk menginstal Laravel, kita bisa menggunakan Composer...',
                'publish_date' => Carbon::now()->addDays(1),
                'status' => 'Schedule',
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Pengenalan Laravel Jetstream',
                'content' => 'Laravel Jetstream adalah framework untuk autentikasi tingkat lanjut...',
                'publish_date' => Carbon::now()->addDays(1),
                'status' => 'Schedule',
                'user_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Laravel vs CodeIgniter',
                'content' => 'Laravel dan CodeIgniter adalah framework PHP yang populer...',
                'publish_date' => Carbon::now()->addDays(7),
                'status' => 'Schedule',
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            
            // Draft posts
            [
                'title' => 'Eloquent ORM untuk Pemula',
                'content' => 'Eloquent ORM memudahkan kita dalam mengelola database...',
                'publish_date' => Carbon::now()->addDays(2),
                'status' => 'Draft',
                'user_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Mengenal Middleware Laravel',
                'content' => 'Middleware digunakan untuk menangani request sebelum diteruskan ke controller...',
                'publish_date' => Carbon::now()->addDays(2),
                'status' => 'Draft',
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Cara Membuat CRUD di Laravel',
                'content' => 'CRUD (Create, Read, Update, Delete) adalah operasi dasar dalam aplikasi...',
                'publish_date' => Carbon::now()->addDays(2),
                'status' => 'Draft',
                'user_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
        
    }
}
