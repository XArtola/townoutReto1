<?php

use Illuminate\Database\Seeder;
use App\ContactMessage;

class ContactMessageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContactMessage::create(
            [
                'nombre' => 'Jazmin',
                'apellido' => 'Warren',
                'email' => 'jazmin@warren.com',
                'mensaje' => 'Unable to login'
            ]
        );
        ContactMessage::create(

            [
                'nombre' => 'Kadyn',
                'apellido' => 'Elliott',
                'email' => 'Kadyn@Elliott.com',
                'mensaje' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In placerat gravida mollis. Aliquam consequat ante dui, a elementum ipsum blandit quis. Vivamus vel scelerisque ex, at fringilla eros. Proin dui turpis, eleifend id dictum sit amet, lobortis non mauris. Praesent tempor, erat sodales cursus efficitur, ex mi accumsan risus, dignissim pretium nulla odio id nulla. Ut vitae massa nunc. Donec euismod tristique feugiat. Aliquam erat volutpat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Suspendisse potenti. Pellentesque at purus mi. Praesent orci purus, pulvinar ut lacus pretium, mollis varius turpis. Proin nec augue id lectus bibendum eleifend. ',
                'active' => false
            ]
        );
        ContactMessage::create(

            [
                'nombre' => 'Jazmin',
                'apellido' => 'Cooper',
                'email' => 'Misael@Cooper.com',
                'mensaje' => 'Aenean euismod sapien lorem, quis egestas ligula tempor ut. Mauris a mollis nulla, quis suscipit tortor. Maecenas sed justo a ex ornare molestie. Sed iaculis tortor eget odio volutpat, id aliquam massa pretium. Etiam iaculis ligula sit amet iaculis dictum. Proin neque mauris, congue quis convallis eget, auctor a augue. Donec eget scelerisque nibh. Pellentesque mollis lectus nulla, vel tempus quam euismod id. Etiam diam quam, lobortis ut ex eu, sagittis facilisis ipsum. Curabitur luctus ex at enim consectetur, a porttitor tellus euismod. Vivamus aliquet at metus a consectetur. ',
                'active' => true

            ]
        );
    }
}
