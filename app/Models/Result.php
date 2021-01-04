<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $invites_id
 * @property integer $job_id
 * @property string $position
 * @property string $pass_time
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property Invite $invite
 * @property Job $job
 * @property User $user
 * @property BelbinUser[] $belbinUsers
 * @property UserMeaning[] $userMeanings
 * @property UserMotivation[] $userMotivations
 * @property UserMotive[] $userMotives
 * @property UserScale[] $userScales
 */
class Result extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'invites_id', 'job_id', 'position', 'pass_time', 'status', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function invite()
    {
        return $this->belongsTo('App\Models\Invite', 'invites_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function job()
    {
        return $this->belongsTo('App\Models\Job');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function belbinUsers()
    {
        return $this->hasMany('App\Models\BelbinUser');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userMeanings()
    {
        return $this->hasMany('App\Models\UserMeaning');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userMotivations()
    {
        return $this->hasMany('App\Models\UserMotivation');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userMotives()
    {
        return $this->hasMany('App\Models\UserMotive');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userScales()
    {
        return $this->hasMany('App\Models\UserScale');
    }

    public static function makeData($data){
        $model = new self();
        $model->user_id = Auth::id();
        $model->invites_id = $data["invite"];
        $model->job_id = $data["job_id"];
        $model->position = Auth::user()->position;
        $model->pass_time = Carbon::now();
        $model->status = 1;
        $model->save();
        return $model->id;
    }

    public static function checkSoloviev($data){
        $invite = Invite::where("user_id",Auth::id())->orWhere("department_id",Auth::user()->department_id)->find($data['invite']);
        if($invite){
            $result_id = self::makeData($data);
            if($result_id){
            if($invite->user_id){$invite->status =1 ;$invite->save();}
            $motives = [];
            $scales = [];
            $meaning = [];
            foreach ($data["oven_answer"] as $answer){
                $i = 1;
                foreach ($answer->value as $liter){
                    $index = MotiveQuestion::where(["question_id"=>$answer->question_id,"answer"=>$liter])->first();
                    if($index){
                        if(isset($motives[$index->motive_id])){
                            $motives[$index->motive_id] +=$i;
                        }
                        else{
                            $motives[$index->motive_id] = 0;
                            $motives[$index->motive_id] +=$i;
                        }
                        $i++;
                    }
                }
            }
            foreach ($data["answer"][2] as $id => $value){
                $index = ScaleQuestion::where(["question_id"=>$id,"answer"=>$value[0]])->first();
                if($index){
                    if(isset($scales[$index->scale_id])){
                        $scales[$index->scale_id] += 10;
                    }
                    else{
                        $scales[$index->scale_id] = 0;
                        $scales[$index->scale_id] +=10;
                    }
                }
            }
            foreach ($data["answer"][3] as $id => $value){
                $index = MeaningQuestion::where(["answer"=>$value[0],"question_id"=>$id])->first();
                if($index){
                    $model = new UserMeaning();
                    $meaning["user_id"] = Auth::id();
                    $meaning["meaning"] = $index->meaning;
                    $meaning["meaning_id"] = $index->id;
                    $meaning["result_id"] = $result_id;
                    $model->fill($meaning);
                    $model->save();
                }
            }
            $user_motives = [];
            $user_scales = [];
            $motivation = 0;
            $counter = 0;
            $i = 0;
            foreach ($motives as $key => $motive){
                $model = new UserMotive();
                $user_motives[$i]["user_id"] = Auth::id();
                $user_motives[$i]["result_id"] = $result_id;
                $user_motives[$i]["motive_id"] = $key;
                $user_motives[$i]["rating"] = $motive;
                $percentage = 100 - (($motive - 10) *2);
                $user_motives[$i]["percentage"] = $percentage;
                if($percentage >= 70){
                    $user_motives[$i]["meaning"] = "Сильно выраженные мотивы к работе – от 70% и больше";
                }
                else if($percentage >= 50 && $percentage < 70){
                    $user_motives[$i]["meaning"] = "Средне выраженные мотивы к работе – от 50% до 68%";
                }
                else{
                    $user_motives[$i]["meaning"] = "Слабо выраженные мотивы к работе – менее 50%";
                }
                if($percentage>50){
                    $motivation += $percentage;
                    $counter++;
                }
                $model->fill($user_motives[$i]);
                $model->save();
                $i++;
            }
//
            $i=0;
            foreach ($scales as $key => $value){
                $model = new UserScale();
                    $user_scales[$i]["user_id"] = Auth::id();
                    $user_scales[$i]["result_id"] = $result_id;
                    $user_scales[$i]["scale_id"] = $key;
                    $user_scales[$i]["rating"] = $value/10;
                    $user_scales[$i]["percentage"] = $value;
                    if($key == 1){
                        if($value>50){
                            $user_scales[$i]["meaning"] = "Высокий уровень признаков трудоголика – выше 50%";
                        }
                        else if($value>= 30 && $value <= 50){
                            $user_scales[$i]["meaning"] = "Средний уровень признаков трудоголика – от 30% до 50% ";
                        }
                        else{
                            $user_scales[$i]["meaning"] = "Низкий уровень признаков трудоголика – от 0% до 20%";
                        }
                    }
                    else if($key == 2){
                        if($value>= 0 && $value <= 20){
                            $user_scales[$i]["meaning"] = "Адекватная самооценка (от 0% до 20%) – «откровенный»";
                        }
                        else if($value> 20 && $value <= 40){
                            $user_scales[$i]["meaning"] = "Небольшое завышение самооценки (30%) – «ситуативный»";
                        }
                        else{
                            $user_scales[$i]["meaning"] = "Лживый";
                        }
                    }
                    $model->fill($user_scales[$i]);
                    $model->save();
                    $i++;
            }
//
            if($counter !=0){
                $user_motivation["rating"] = $motivation/$counter;
            }
            else{
                $user_motivation["rating"] = $motivation;
            }
            $user_motivation["user_id"] = Auth::id();
            $user_motivation["result_id"] = $result_id;
            if($user_motivation["rating"] > 44){
                $user_motivation["meaning"] = "Высокий общий уровень мотивации к работе – 44 балла и больше";
            }
            else if($user_motivation["rating"] >= 32 && $user_motivation["rating"] <= 44){
                $user_motivation["meaning"] = "Средний общий уровень мотивации к работе – от 32 до 44 баллов ";
            }

            else{
                $user_motivation["meaning"] = "Низкий общий уровень мотивации к работе – меньше 32 баллов";
            }
            $model = new UserMotivation();
            $model->fill($user_motivation);
            $model->save();
            return true;

        }
            else{
                return false;
            }
        }
        else{
            return false;
        }



    }
}
