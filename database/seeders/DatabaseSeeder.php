<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\Core\Models\FooterLink;
use Modules\Core\Models\Section;
use Modules\User\Models\User;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);
        Role::create(['name' => 'super-admin']);
        $admin = User::create([
            'username' => 'admin',
            'name' => 'ادمین',
            'email' => 'admin@gmail.com',
            'password' => Hash::make(env('ADMIN_PASSWORD')),
            'number' => 9903001905,
        ]);
        $admin->assignRole('super-admin');
        $fields = [
            'titleHeader' => [
                'content' => 'images/titleHeader.jpg',
            ],
            'titleFooter' => [
                'content' => 'images/titleFooter.jpg',
            ],
            'defaultContentImage' => [
                'content' => 'images/defaultContentImage.jpg',
            ],
            'aboutUs' => [
                'content' => 'موسسه ما با هدف ارائه خدمات آموزشی، پژوهشی و فرهنگی به طلاب و علاقه‌مندان به علوم اسلامی تأسیس شده است. با تیمی مجرب و متخصص، تلاش می‌کنیم تا بستری مناسب برای یادگیری و تبادل نظر فراهم کنیم.',
            ],
            'contactUs' => [
                'content' => 'برای ارتباط با ما می‌توانید از طریق فرم تماس، شماره تلفن‌های موجود و یا آدرس ایمیل درج‌شده در این بخش اقدام کنید. همچنین دفتر موسسه در ساعات اداری آماده پاسخ‌گویی به شما عزیزان است.',
            ],
            'magazineGuide' => [
                'content' => 'جهت ثبت و ارسال مقاله، لطفاً نکات زیر را رعایت کنید: محتوای مقاله باید با موضوعات آموزشی و فرهنگی موسسه هم‌خوانی داشته باشد. مقاله‌های شما پس از بررسی و تأیید منتشر می‌شوند.',
            ],
        ];

        foreach ($fields as $key => $field) {
            Section::create([
                'name' => $key,
                'content' => $field['content'],
            ]);
        }

        $Links = [
            'موسسه معصومیه' => 'masoumieh.ir',
        ];

        foreach ($Links as $name => $url) {
            FooterLink::create([
                'name' => $name,
                'link' => $url,
            ]);
        }
    }
}
