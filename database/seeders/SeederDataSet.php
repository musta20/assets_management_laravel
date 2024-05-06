<?php

namespace Database\Seeders;

class SeederDataSet
{

    public static function AssetsArray()
    {


        return [
            [
                "name" => "شاشة عرض", // ism al-muntaj - Product Name
                "description" => "شاشة عرض عالية الدقة بمقاس 55 بوصة و تقنية LED توفر ألوانًا زاهية وواضحة للمشاهدة.", // al-wasf - Description
            ],
            [
                "name" => "هاتف ذكي",
                "description" => "هاتف ذكي يعمل بنظام اندرويد مع شاشة عرض 6.5 بوصة و كاميرا خلفية ثلاثية 48 ميجابكسل.",
            ], [

                "name" => "سماعات لاسلكية",
                "description" => "سماعات لاسلكية توفر صوتًا نقيًا وعالي الجودة مع عمر بطارية يصل إلى 8 ساعات.",
            ],
            [
                "name" => "لوحة مفاتيح لاسلكية",
                "description" => "لوحة مفاتيح لاسلكية نحيفة وانيقة تعمل بالبلوتوث وتتصل بالكمبيوتر أو اللابتوب.",
            ],
            [
                "name" => "كاميرا رقمية",
                "description" => "كاميرا رقمية احترافية بمستشعر CMOS كامل الإطار بدقة 42 ميجابكسل للصور عالية الجودة.",
            ],
            [
                "name" => "طابعة متعددة الوظائف",
                "description" => "طابعة متعددة الوظائف يمكنها الطباعة, النسخ, والمسح الضوئي بالألوان والأسود والأبيض.",
            ],
            [
                "name" => "مسجل صوت رقمي",
                "description" => "مسجل صوت رقمي محمول بحجم صغير وسهل الاستخدام لتسجيل المحاضرات والاجتماعات.",
            ],
            [
                "name" => "مشغل ألعاب فيديو",
                "description" => "مشغل ألعاب فيديو متطور يدعم ألعاب عالية الدقة ويوفر تجربة لعب غامرة.",
            ],
            [
                "name" => "كابل شحن",
                "description" => "كابل شحن سريع متوافق مع معظم أنواع الهواتف الذكية والأجهزة اللوحية.",
            ],
            [
                "name" => "بطاقة ذاكرة",
                "description" => "بطاقة ذاكرة بسعة تخزين عالية لتوسيع مساحة تخزين أجهزتك الإلكترونية.",
            ]
        ];
    }


    public static function DepartmentsArray()
    {
        return [
            [
                "name" => "المديرية العامة",
                "description" => "مديرية عامة للشركة",
            ],
            [
                "name" => "المديرية المالية",
                "description" => "مديرية عامة للرئيس المالي",
            ],
            [
                "name" => "المديرية التسويقية",
                "description" => "مديرية للعملاء والتسويق",
            ],
        ];
    }


    public static function LocationsArray()
    {
        return [
            [
                "name" => "المركز الرئيسي",
                "description" => "المركز الرئيسي",
                "address" => "العلمية الشرقية شارع الملك سعد بجداد",
                "site" => "www.example.com",
                "department" => "المديرية العامة",
            ],
            [
                "name" => "المركز الأساق",
                "description" => "المركز الأساق",
                "address" => "العلمية الشرقية شارع الملك سعد بجداد",
                "site" => "www.example.com",
                "department" => "المديرية المالية",
            ],
            [
                "name" => "المركز التسويقي",
                "description" => "المركز التسويقي",
                "address" => "العلمية الشرقية شارع الملك سعد بجداد",
                "site" => "www.example.com",
                "department" => "المديرية التسويقية",
            ],
            [
                "name" => "المركز الموظفين",
                "description" => "المركز الموظفين",
                "address" => "العلمية الغربية شارع الهرم ",
                "site" => "www.example.com",
                "department" => "المديرية التسويقية",
            ]

        ];
    }


    public static function VenderBrandsArray()
    {
        return [
            [
                "name" => "Apple",
                "phone_number" => "01011151112",
                "address" => "العلمية الشرقية شارع الملك سعد بجداد",
                "contact_person" => "محمد عبدالعزيز",
                "email" => "apple@gmail.com",
            ],
            [
                "name" => "Microsoft",
                "phone_number" => "01010003847",
                "address" => "العلمية الشرقية شارع الملك سعد بجداد",
                "contact_person" => "سعيد محمد",
                "email" => "microsoft@gmail.com",
            ],
            [
                "name" => "Lenovo",
                "phone_number" => "01000015151",
                "address" => "العلمية الشرقية شارع الملك سعد بجداد",
                "contact_person" => "سليمان علي",
                "email" => "lenovo@gmail.com",
            ],
            [
                "name" => "HP",
                "phone_number" => "01000015156",
                "address" => "العلمية الشرقية شارع الملك سعد بجداد",
                "contact_person" => "حسان محمد",
                "email" => "hp@gmail.com",
            ],
            [
                "name" => "Dell",
                "phone_number" => "01000015188",
                "address" => "العلمية الشرقية شارع الملك سعد بجداد",
                "contact_person" => "عباس محمد",
                "email" => "dell@gmail.com",
            ],
            [
                "name" => "Asus",
                "phone_number" => "01000015122",
                "address" => "العلمية الشرقية شارع الملك سعد بجداد",
                "contact_person" => "محمد عبد الهادي",
                "email" => "asus@gmail.com",
            ],
        ];
    }


    public static function categoriesArray()
    {
        return [
            [
                "name" => "معلومات",
                "description" => "معلومات عامة وتفاصيل عن الأخبار"
            ],
            [
                "name" => "اقتصاد",
                "description" => "معلومات عن الأسعار والسوق والأعمال"
            ],
            [
                "name" => "ثقافة وثواق",
                "description" => "معلومات عن الأحيان والمهارات والأعلام"
            ],
            [
                "name" => "تكنولوجيا",
                "description" => "معلومات عن التكنولوجيا والأجهزة والبروتوكولات"
            ],
            [
                "name" => "صناعة وتعليم",
                "description" => "معلومات عن الأجهزة التي تعمل والأساتذة"
            ],
            [
                "name" => "حكمة وجماعة",
                "description" => "معلومات عن الأجهزة التي تعمل والأساتذة"
            ],
            [
                "name" => "حيوان وطب",
                "description" => "معلومات عن الأحيان والأمراض والعلاج"
            ],
            [
                "name" => "أعمال وسياحة",
                "description" => "معلومات عن الأعمال والسياحة والوجهات"
            ],
            [
                "name" => "فن وفنون",
                "description" => "معلومات عن الفن والفنون والأرواح"
            ],
            [
                "name" => "رياضة وتربية",
                "description" => "معلومات عن الأشخاص المهتمين بالرياضة والتربية"
            ],
            [
                "name" => "علم وعلماء",
                "description" => "معلومات عن العلم والأعلام والأشخاص المهتمين بالعلم"
            ],

        ];
    }
}
