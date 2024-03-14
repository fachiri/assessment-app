<?php

namespace App\Constants;

class Option
{
  public const FORM_TYPE = [
    [
      'label' => 'Jawaban Singkat',
      'value' => 'short_answer'
    ],
    [
      'label' => 'Paragraf',
      'value' => 'paragraph'
    ],
    [
      'label' => 'Pilihan Ganda',
      'value' => 'multiple_choice'
    ],
    [
      'label' => 'Kotak Centang',
      'value' => 'checkboxes'
    ],
    [
      'label' => 'Dropdown',
      'value' => 'dropdown'
    ],
    [
      'label' => 'Tanggal',
      'value' => 'date'
    ]
  ];
}
