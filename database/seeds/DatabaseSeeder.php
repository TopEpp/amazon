<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
            'username' => 'admin',
            'name' => 'หจก. แม่สอดชานนทร์',
            'phone' => '1111111111',
            'password' => bcrypt('123456'),
            'site_code'=>'0001',
            'address' => '88 ถ.สายเอเชีย ต.แม่สอด อ.แม่สอด จ.ตาก 63110',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('categorys')->insert([[
            // 'id' => '1',
            'name' => 'วัตถุดิบ',
        ],[
            // 'id' => '2',
            'name' => 'ขนมและเครื่องดื่ม',
        ],[
            // 'id' => '3',
            'name' => 'วัสดุสิ้นเปลือง',
        ],[
            // 'id' => '4',
            'name' => 'เครื่องมืออุปกรณ์',
        ],[
            // 'id' => '5',
            'name' => 'Marketing',
        ],[
            // 'id' => '6',
            'name' => 'อื่นๆ',
        ]]);

        DB::table('units')->insert([[
            // 'id' => '1',
            'name' => 'ซอง',
        ],[
            // 'id' => '2',
            'name' => 'ขวด',
        ],[
            // 'id' => '3',
            'name' => 'ถุง',
        ],[
            // 'id' => '4',
            'name' => 'กระป๋อง',
        ],[
            // 'id' => '5',
            'name' => 'กล่อง',
        ],[
            // 'id' => '6',
            'name' => 'Pack',
        ],[
            // 'id' => '7',
            'name' => 'ใบ',
        ],[
            // 'id' => '8',
            'name' => 'ฝา',
        ],[
            // 'id' => '9',
            'name' => 'ชิ้น',
        ],[
            // 'id' => '10',
            'name' => 'ชุด',
        ],[
            // 'id' => '11',
            'name' => 'ตัว',
        ],[
            // 'id' => '12',
            'name' => 'เครื่อง',
        ]]);

        DB::table('products')->insert([[
            'category_id'=>'1',
            'name' => 'ผงโกโก้ปรุงสำเร็จ AMAZON',
            'price' => '0',
            'code' => '1000141',
            'unit_id' => '1',
        ],[
            'category_id'=>'1',
            'name' => 'ชาดำ AMAZON',
            'price' => '0',
            'code' => '1000199',
            'unit_id' => '1',
        ],[
            'category_id'=>'1',
            'name' => 'น้ำหวานลิ้นจี่',
            'price' => '0',
            'code' => '1000206',
            'unit_id' => '2',
        ],[
            'category_id'=>'1',
            'name' => 'ใบชาเขียว',
            'price' => '0',
            'code' => '1000208',
            'unit_id' => '1',
        ],[
            'category_id'=>'1',
            'name' => 'ครีมเทียมกลิ่นกาแฟ',
            'price' => '0',
            'code' => '1000209',
            'unit_id' => '1',
        ],[
            'category_id'=>'1',
            'name' => 'ครีมเทียมกลิ่นชาเขียว',
            'price' => '0',
            'code' => '1000210',
            'unit_id' => '1',
        ],[
            'category_id'=>'1',
            'name' => 'น้ำผึ้ง ตรา คาเฟ่อเมซอน 500 กรัม',
            'price' => '0',
            'code' => '1000656',
            'unit_id' => '2',
        ],[
            'category_id'=>'1',
            'name' => 'อเมซอนเบลน 500 กรัม',
            'price' => '0',
            'code' => '1001606',
            'unit_id' => '1',
        ],[
            'category_id'=>'1',
            'name' => 'น้ำเชื่อมกลิ่นช็อกโกแลตคุกกี้ new product',
            'price' => '0',
            'code' => '1001726',
            'unit_id' => '2',
        ],[
            'category_id'=>'1',
            'name' => 'นมข้นหวาน AMAZON',
            'price' => '0',
            'code' => '1002138',
            'unit_id' => '3',
        ],[
            'category_id'=>'1',
            'name' => 'นมข้นจืด AMAZON',
            'price' => '0',
            'code' => '1002786',
            'unit_id' => '4',
        ],[
            'category_id'=>'1',
            'name' => 'อเมซอน ดริป คอฟฟี่ (ปางขอน)',
            'price' => '0',
            'code' => '1002888',
            'unit_id' => '5',
        ],[
            'category_id'=>'1',
            'name' => 'น้ำเชื่อมกลิ่นทับทิม new product',
            'price' => '0',
            'code' => '1002897',
            'unit_id' => '2',
        ],[
            'category_id'=>'1',
            'name' => 'น้ำเชื่อมกลิ่นผลไม้รวม new product',
            'price' => '0',
            'code' => '1002908',
            'unit_id' => '2',
        ],[
            'category_id'=>'2',
            'name' => ' น้ำดื่ม CAFE AMAZON PI-WATER',
            'price' => '0',
            'code' => '1000141',
            'unit_id' => '2',
        ],[
            'category_id'=>'2',
            'name' => 'A35_ขนมปั้นขลิบทอดไส้ไก่หยอง',
            'price' => '0',
            'code' => '1001596',
            'unit_id' => '4',
        ],[
            'category_id'=>'2',
            'name' => 'A50_พายแยมสตรอเบอรี่ พรีเมี่ยม',
            'price' => '0',
            'code' => '1001728',
            'unit_id' => '4',
        ],[
            'category_id'=>'2',
            'name' => 'A44_ขนมปังกรอบรสเนยสดพรีเมี่ยม',
            'price' => '0',
            'code' => '1001660',
            'unit_id' => '4',
        ],[
            'category_id'=>'2',
            'name' => 'A45_ขนมปังกรอบรสกระเทียมพรีเมี่ยม',
            'price' => '0',
            'code' => '1001661',
            'unit_id' => '4',
        ],[
            'category_id'=>'2',
            'name' => 'A51_เมอแรงค์นัท',
            'price' => '0',
            'code' => '1001729',
            'unit_id' => '4',
        ],[
            'category_id'=>'2',
            'name' => 'A60_ถั่วลิสงอบกรอบ รสวาซาบิ',
            'price' => '0',
            'code' => '1001739',
            'unit_id' => '4',
        ],[
            'category_id'=>'2',
            'name' => 'คาราเมลวาฟเฟิล ตราคาเฟ่อเมซอน',
            'price' => '0',
            'code' => '1002159',
            'unit_id' => '1',
        ],[
            'category_id'=>'2',
            'name' => 'A75_แครกเกอร์สัปปะรด ตราคาเฟ่อเมซอน',
            'price' => '0',
            'code' => '1002217',
            'unit_id' => '4',
        ],[
            'category_id'=>'2',
            'name' => 'A78_ทองม้วนกรอบรสมะพร้าวใส่งา',
            'price' => '0',
            'code' => '1002306',
            'unit_id' => '3',
        ],[
            'category_id'=>'2',
            'name' => 'D08_น้ำส้มอเมซอน 280 มล.',
            'price' => '0',
            'code' => '1002409',
            'unit_id' => '2',
        ],[
            'category_id'=>'3',
            'name' => 'แก้วพลาสติก 22 OZ.',
            'price' => '0',
            'code' => '1000061',
            'unit_id' => '7',
        ],[
            'category_id'=>'3',
            'name' => 'กระดาษทิชชู่อเมซอน',
            'price' => '0',
            'code' => '1000063',
            'unit_id' => '6',
        ],[
            'category_id'=>'3',
            'name' => 'แก้วพลาสติก 16 OZ.',
            'price' => '0',
            'code' => '1000064',
            'unit_id' => '7',
        ],[
            'category_id'=>'3',
            'name' => 'หลอดตรงห่อกระดาษ AMAZON',
            'price' => '0',
            'code' => '1000101',
            'unit_id' => '6',
        ],[
            'category_id'=>'3',
            'name' => 'ผ้าหมึก EPSON รุ่น ERC-38 B/R (สีดำ/แดง)',
            'price' => '0',
            'code' => '1000446',
            'unit_id' => '5',
        ],[
            'category_id'=>'3',
            'name' => 'ถุงพลาสติก 1 ช่องใส่แก้ว',
            'price' => '0',
            'code' => '1000566',
            'unit_id' => '6',
        ],[
            'category_id'=>'3',
            'name' => 'ถุงพลาสติก 2 ช่องใส่แก้ว',
            'price' => '0',
            'code' => '1000567',
            'unit_id' => '6',
        ],[
            'category_id'=>'3',
            'name' => 'ฝาแก้วพลาสติก 22 OZ.',
            'price' => '0',
            'code' => '4000061',
            'unit_id' => '8',
        ],[
            'category_id'=>'3',
            'name' => 'ฝาแก้วพลาสติก 16 OZ.',
            'price' => '0',
            'code' => '4000064',
            'unit_id' => '8',
        ],[
            'category_id'=>'4',
            'name' => 'แก้วกระเบื้องพร้อมจานรอง 7 OZ.',
            'price' => '0',
            'code' => '1000059',
            'unit_id' => '10',
        ],[
            'category_id'=>'4',
            'name' => 'ป้ายราคา ขนาด 4X6 ซม.',
            'price' => '0',
            'code' => '1000070',
            'unit_id' => '6',
        ],[
            'category_id'=>'4',
            'name' => 'เสื้อพนักงานหญิง M ',
            'price' => '0',
            'code' => '1000084',
            'unit_id' => '11',
        ],[
            'category_id'=>'4',
            'name' => 'แก้ว SHOT 1.5 ออนซ์',
            'price' => '0',
            'code' => '1000108',
            'unit_id' => '7',
        ],[
            'category_id'=>'4',
            'name' => 'ขวดพลาสติกใส่นมข้น AMAZON 24 OZ.',
            'price' => '0',
            'code' => '1000181',
            'unit_id' => '7',
        ],[
            'category_id'=>'4',
            'name' => 'ผ้ากันเปื้อน CAFE AMAZON ',
            'price' => '0',
            'code' => '1000250',
            'unit_id' => '10',
        ],[
            'category_id'=>'5',
            'name' => 'ขวดแสตนเลสอเมซอน 15 ปี',
            'price' => '0',
            'code' => '1002415',
            'unit_id' => '7',
        ],[
            'category_id'=>'5',
            'name' => 'พวงกุญแจ MACAW  new product',
            'price' => '0',
            'code' => '1002703',
            'unit_id' => '9',
        ],[
            'category_id'=>'5',
            'name' => 'กระเป๋า“AMAZON SPORT BAG” ',
            'price' => '0',
            'code' => '1002746',
            'unit_id' => '7',
        ],[
            'category_id'=>'5',
            'name' => 'หมอนรองคอ 2 IN 1 ',
            'price' => '0',
            'code' => '1002865',
            'unit_id' => '7',
        ],[
            'category_id'=>'6',
            'name' => 'เครื่องสำรองไฟ',
            'price' => '0',
            'code' => '5000001',
            'unit_id' => '12',
        ]]);

    }
}
