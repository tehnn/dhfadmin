<?php

/**
 * This is the model class for table "vwexcel".
 *
 * The followings are the available columns in table 'vwexcel':
 * @property string $off_name
 * @property string $prename
 * @property string $name
 * @property string $lname
 * @property string $sex
 * @property string $agey
 * @property string $code506
 * @property string $date_ill
 * @property string $date_found
 * @property string $addr
 * @property string $moo
 * @property string $tambon
 * @property string $amphur
 * @property string $hospcode
 * @property string $hospname
 * @property string $disease_control
 */
class Vwexcel extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'vwexcel';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('off_name,prename, name, lname, agey, code506, addr, hospname', 'length', 'max' => 100),
            array('sex', 'length', 'max' => 25),
            array('moo', 'length', 'max' => 18),
            array('tambon', 'length', 'max' => 14),
            array('amphur', 'length', 'max' => 10),
            array('hospcode', 'length', 'max' => 5),
            array('disease_control', 'length', 'max' => 21),
            array('date_ill, date_found', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('off_name,prename, name, lname, sex, agey, code506, date_ill, date_found, addr, moo, tambon, amphur, hospcode, hospname, disease_control', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'off_name' => 'รักษาที่',
            'prename' => 'คำนำหน้า',
            'name' => 'ชื่อ',
            'lname' => 'นามสกุล',
            'sex' => 'เพศ',
            'agey' => 'อายุ(ปี)',
            'code506' => 'รหัสโรค',
            'date_ill' => 'วันป่วย',
            'date_found' => 'วันพบ',
            'addr' => 'บ้านเลขที่',
            'moo' => 'หมู่',
            'tambon' => 'ตำบล',
            'amphur' => 'อำเภอ',
            'hospcode' => 'สถานบริการ',
            'hospname' => 'ชื่อสถานบริการ',
            'disease_control' => 'สอบสวน/ควบคุม(ครั้ง)',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search($merge = null) {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->compare('off_name', $this->off_name, true);
        $criteria->compare('prename', $this->prename, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('lname', $this->lname, true);
        $criteria->compare('sex', $this->sex, true);
        $criteria->compare('agey', $this->agey, true);
        $criteria->compare('code506', $this->code506, true);
        $criteria->compare('date_ill', $this->date_ill, true);
        $criteria->compare('date_found', $this->date_found, true);
        $criteria->compare('addr', $this->addr, true);
        $criteria->compare('moo', $this->moo, true);
        $criteria->compare('tambon', $this->tambon, true);
        $criteria->compare('amphur', $this->amphur, true);
        $criteria->compare('hospcode', $this->hospcode, true);
        $criteria->compare('hospname', $this->hospname, true);
        $criteria->compare('disease_control', $this->disease_control, true);

        if ($merge !== null){
            $criteria->mergeWith($merge,'AND');
        }
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Vwexcel the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
