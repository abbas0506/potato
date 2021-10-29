<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
   use HasFactory;
   protected $fillable = [
      'name',
      'phone',
      'dob',
      'bform',
      'bise_id',
      'passyear',
      'rollno',
      'marks',
      'concession',
      'group_id',
      'image',
      'bloodgroup',
      'speciality',
      'address',
      'distance',
      'preschool_id',
      'fname',
      'fcnic',
      'mname',
      'mcnic',
      'grelation',
      'gname',
      'gcnic',
      'profession',
      'income',
      //scrutiny info
      'haspics',
      'hasgcnic',
      'hasbform',
      'hasmatric',
      'hasnoc',
      'isdobcorrect',
      'isbformcorrect',
      'ismarkscorrect',
      //fee
      'paidat',
      'createdat',
   ];

   public $timestamps = false;
   protected $dateFormat = 'Y-m-d';
   protected $dates = ['dob', 'paidat', 'createdat'];

   public function group()
   {
      return $this->belongsTo(Group::class, 'group_id');
   }
   public function section()
   {
      return $this->belongsTo(Section::class, 'section_id');
   }
   public function bise()
   {
      return $this->belongsTo(Bise::class, 'bise_id');
   }
   public function preschool()
   {
      return $this->belongsTo(Preschool::class, 'preschool_id');
   }
   public function isOtherBoard()
   {
      if ($this->bise_id != 1) return true;
      else return false;
   }
   public function deficiencies()
   {
      $list = collect();
      if ($this->haspics == 0)  $list->push('Pics');
      if ($this->hasgcnic == 0)  $list->push('Guaridan cnic');
      if ($this->hasbform == 0)  $list->push('B Form');
      if ($this->hasmatric == 0)  $list->push('Matric result');
      if ($this->isOtherBoard() && !$this->hasnoc)  $list->push('NOC');

      return $list;
   }
   public function deficiencyCode()
   {
      $code = '';
      if ($this->haspics == 0)  $code .= 'P';
      if ($this->hasgcnic == 0) $code .= 'C';
      if ($this->hasbform == 0) $code .= 'B';
      if ($this->hasmatric == 0) $code .= 'M';
      if ($this->isOtherBoard() && !$this->hasnoc)  $code .= 'N';

      return $code;
   }

   public function hasDeficiency()
   {
      if ($this->haspics == 0) return true;
      else if ($this->hasgcnic == 0) return true;
      else if ($this->hasbform == 0) return true;
      else if ($this->hasmatric == 0) return true;
      else if ($this->bise_id != 1 && $this->hasnoc == 0) return true;
      else return false;
   }

   public static function havingDeficiency()
   {
      $feepayers = Registration::whereNotNull('paidat')->get();
      $list = collect();
      foreach ($feepayers as $feepayer) {
         if ($feepayer->hasDeficiency()) $list->push($feepayer);
      }

      return $list;
   }

   public static function havingClearance()
   {

      $otherBoardClearance = Registration::whereNotNull('paidat')
         ->where('bise_id', '!=', 1)
         ->where('hasnoc', 1)
         ->where('haspics', 1)
         ->where('hasgcnic', 1)
         ->where('hasbform', 1)
         ->where('hasmatric', 1);

      $sameBoardClearance = Registration::whereNotNull('paidat')
         ->where('bise_id',  1)
         ->where('hasnoc', 0)
         ->where('haspics', 1)
         ->where('hasgcnic', 1)
         ->where('hasbform', 1)
         ->where('hasmatric', 1);

      return $otherBoardClearance->union($sameBoardClearance)->orderBy('id')->get();
   }
   public function feepayers()
   {
      $feepayers = Registration::whereNotNull('paidAt')->get();
      return $feepayers;
   }
}