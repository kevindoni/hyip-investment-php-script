<?php
return [
    'hero' => [
        'field_name' => [
            'title' => 'text',
            'sub_title' => 'text',
            'short_description' => 'textarea',
            'button_name' => 'text',
            'button_link' => 'url',
            'image' => 'file',
            'background_image' => 'file',
        ],
        'validation' => [
            'title.*' => 'required|max:100',
            'short_description.*' => 'required|max:2000',
            'button_name.*' => 'required|max:2000',
            'button_link.*' => 'required|max:2000',
            'background_image.*' => 'nullable|max:3072|image|mimes:jpg,jpeg,png',
            'image.*' => 'nullable|max:3072|image|mimes:jpg,jpeg,png',
        ]
    ],
    'about-us' => [
        'field_name' => [
            'title' => 'text',
            'sub_title' => 'text',
            'short_title' => 'text',
            'short_description' => 'textarea',
            'image' => 'file'
        ],
        'validation' => [
            'title.*' => 'required|max:100',
            'sub_title.*' => 'required|max:100',
            'short_description.*' => 'required|max:2000',
            'image.*' => 'nullable|max:3072|image|mimes:jpg,jpeg,png',
        ]
    ],
    'investment' => [
        'field_name' => [
            'title' => 'text',
            'sub_title' => 'text',
            'short_details' => 'textarea',
        ],
        'validation' => [
            'title.*' => 'required|max:100',
            'sub_title.*' => 'required|max:100',
            'short_details.*' => 'required|max:2000'
        ]
    ],
    'why-chose-us' => [
        'field_name' => [
            'title' => 'text',
            'sub_title' => 'text',
            'short_details' => 'textarea',
        ],
        'validation' => [
            'title.*' => 'required|max:100',
            'sub_title.*' => 'required|max:200',
            'short_details.*' => 'required|max:2000'
        ]
    ],
    'how-it-work' => [
        'field_name' => [
            'title' => 'text',
            'sub_title' => 'text',
            'short_details' => 'textarea',
            'youtube_link' => 'url',
            'image' => 'file'

        ],
        'validation' => [
            'title.*' => 'required|max:100',
            'sub_title.*' => 'required|max:200',
            'short_details.*' => 'required|max:2000',
            'image.*' => 'nullable|max:3072|image|mimes:jpg,jpeg,png'
        ],
        'size' => [
            'image' => '960x500'
        ]
    ],
    'how-we-work' => [
        'field_name' => [
            'title' => 'text',
            'sub_title' => 'text',
            'short_details' => 'text',
        ],
        'validation' => [
            'title.*' => 'required|max:100',
            'sub_title.*' => 'required|max:200',
            'short_details.*' => 'required|max:2000'
        ]
    ],
    'request-a-call' => [
        'field_name' => [
            'title' => 'text',
            'sub_title' => 'text',
            'button_name' => 'text',
            'button_link' => 'url'
        ],
        'validation' => [
            'title.*' => 'required|max:100',
            'sub_title.*' => 'required|max:200',
            'button_name.*' => 'required|max:100',
            'button_link.*' => 'required|max:2000'
        ]
    ],
    'deposit-withdraw' => [
        'field_name' => [
            'title' => 'text',
            'sub_title' => 'text',
            'short_title' => 'text',
        ],
        'validation' => [
            'title.*' => 'required|max:100',
            'sub_title.*' => 'required|max:2000',
            'short_title.*' => 'required|max:2000'
        ]
    ],

    'testimonial' => [
        'field_name' => [
            'title' => 'text',
            'sub_title' => 'text',
            'short_title' => 'text',
        ],
        'validation' => [
            'title.*' => 'required|max:100',
            'sub_title.*' => 'required|max:2000',
            'short_title.*' => 'required|max:2000'
        ]
    ],
    'investor' => [
        'field_name' => [
            'title' => 'text',
            'sub_title' => 'text',
            'short_title' => 'text',
        ],
        'validation' => [
            'title.*' => 'required|max:100',
            'sub_title.*' => 'required|max:2000',
            'short_title.*' => 'required|max:2000'
        ]
    ],
    'know-more-us' => [
        'field_name' => [
            'title' => 'text',
            'sub_title' => 'text',
            'short_details' => 'text',
        ],
        'validation' => [
            'title.*' => 'required|max:100',
            'sub_title.*' => 'required|max:200',
            'short_details.*' => 'required|max:2000'
        ]
    ],
    'news-letter' => [
        'field_name' => [
            'title' => 'text',
            'sub_title' => 'text'
        ],
        'validation' => [
            'title.*' => 'required|max:100',
            'sub_title.*' => 'required|max:2000'
        ]
    ],
    'news-letter-referral' => [
        'field_name' => [
            'title' => 'text',
            'sub_title' => 'text',
            'referral_title' => 'text',
            'referral_sub_title' => 'text'
        ],
        'validation' => [
            'title.*' => 'required|max:100',
            'sub_title.*' => 'required|max:2000',
            'referral_title.*' => 'required|max:100',
            'referral_sub_title.*' => 'required|max:2000'
        ]
    ],
    'blog' => [
        'field_name' => [
            'title' => 'text',
            'sub_title' => 'text',
            'short_title' => 'text',
        ],
        'validation' => [
            'title.*' => 'required|max:100',
            'sub_title.*' => 'required|max:2000',
            'short_title.*' => 'required|max:2000'
        ]
    ],
    'faq' => [
        'field_name' => [
            'title' => 'text',
            'sub_title' => 'text',
            'short_details' => 'textarea',
        ],
        'validation' => [
            'title.*' => 'required|max:100',
            'sub_title.*' => 'required|max:100',
            'short_details.*' => 'required|max:2000'
        ]
    ],
    'we-accept' => [
        'field_name' => [
            'title' => 'text',
            'sub_title' => 'text',
            'short_details' => 'textarea',
        ],
        'validation' => [
            'title.*' => 'required|max:100',
            'sub_title.*' => 'required|max:100',
            'short_details.*' => 'required|max:2000'
        ]
    ],
    'contact-us' => [
        'field_name' => [
            'heading' => 'text',
            'sub_heading' => 'text',
            'title' => 'text',
            'address' => 'text',
            'email' => 'text',
            'phone' => 'text',
            'footer_short_details' => 'textarea',
            'image' => 'file'
        ],
        'validation' => [
            'heading.*' => 'required|max:100',
            'sub_heading.*' => 'required|max:100',
            'title.*' => 'required|max:100',
            'address.*' => 'required|max:2000',
            'email.*' => 'required|max:2000',
            'phone.*' => 'required|max:2000',
            'image.*' => 'nullable|max:3072|image|mimes:jpg,jpeg,png',
        ]
    ],
    'message' => [
        'required' => 'This field is required.',
        'min' => 'This field must be at least :min characters.',
        'max' => 'This field may not be greater than :max characters.',
        'image' => 'This field must be image.',
        'background_image' => 'This field must be image.',
        'mimes' => 'This image must be a file of type: jpg, jpeg, png',
    ],
    'template_media' => [
        'image' => 'file',
        'background_image' => 'file',
        'thumbnail' => 'file',
        'youtube_link' => 'url',
        'button_link' => 'url',
    ]
];
