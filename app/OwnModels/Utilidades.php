<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\OwnModels;

use DateTime;
use DateInterval;

/**
 * Description of Utilidades
 *
 */
class Utilidades {
    /**
    * @const int Option to indicates hexadecimal box
    */
    const BOX_HEX = 0;
    /**
    * @const int Option to indicates numeric box
    */
    const BOX_NUMBER = 1;
    /**
    * @const int Option to indicates alphabetic box
    */
    const BOX_ALPHABETIC = 2;
    /**
     *
     * @var array Array with the codes for boxes
     */
    public static $BOXES = [
        self::BOX_HEX => "0123456789abcdef",
        self::BOX_NUMBER => "0123456789",
        self::BOX_ALPHABETIC => "abcdefghijklmnñopqrstuvwxyz",
    ];
    
    /**
     * Arreglo con la información para cantidad de tuplas
     *
     * @var array 
     */
    public static $cantidad_option = [
        10 => 10,
        15 => 15,
        25 => 25,
        50 => 50,
        100 => 100,
        200 => 200,
        500 => 500,
    ];
    
    /**
    * @const int Constante que representa el operador igual
    */
    const OPERADOR_IGUAL = 1;
    /**
    * @const int Constante que representa el operador mayor o igual
    */
    const OPERADOR_MAYOR_IGUAL = 2;
    /**
    * @const int Constante que representa el operador mayor
    */
    const OPERADOR_MAYOR = 3;
    /**
    * @const int Constante que representa el operador menor igual
    */
    const OPERADOR_MENOR_IGUAL = 4;
    /**
    * @const int Constante que representa el operador menor
    */
    const OPERADOR_MENOR = 5;
    /**
     *
     * @var array Arreglo que contiene los operadores disponibles para los querys
     */
    public static $operadores_querys = [
        self::OPERADOR_IGUAL => '=',
        self::OPERADOR_MAYOR_IGUAL => '>=',
        self::OPERADOR_MAYOR => '>',
        self::OPERADOR_MENOR_IGUAL => '<=',
        self::OPERADOR_MENOR => '<',
    ];
    /**
     *
     * @var array Arreglo que contiene las representaciones de los días de la semana
     */
    public static $DAYS_REPRESENTATIONS = array(
        "Sun" => 0,
        "Mon" => 1,
        "Tue" => 2,
        "Wed" => 3,
        "Thu" => 4,
        "Fri" => 5,
        "Sat" => 6
    );
    /**
     *
     * @var array Arreglo que contiene los días de la semana
     */
    public static $DAYS_REPRESENTATIONS_NAMES = [
        "Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado"
    ];
    
    /**
    * @const int Constante que representa el mes de enero
    */
    const MES_ENERO = 1;
    /**
    * @const int Constante que representa el mes de febrero
    */
    const MES_FEBRERO = 2;
    /**
    * @const int Constante que representa el mes de marzo
    */
    const MES_MARZO = 3;
    /**
    * @const int Constante que representa el mes de abril
    */
    const MES_ABRIL = 4;
    /**
    * @const int Constante que representa el mes de mayo
    */
    const MES_MAYO = 5;    
    /**
    * @const int Constante que representa el mes de junio
    */
    const MES_JUNIO = 6;
    /**
    * @const int Constante que representa el mes de julio
    */
    const MES_JULIO = 7;
    /**
    * @const int Constante que representa el mes de agosto
    */
    const MES_AGOSTO = 8;
    /**
    * @const int Constante que representa el mes de septiembre
    */
    const MES_SEPTIEMBRE = 9;
    /**
    * @const int Constante que representa el de octubre
    */
    const MES_OCTUBRE = 10;    
    /**
    * @const int Constante que representa el de noviembre
    */
    const MES_NOVIEMBRE = 11;
    /**
    * @const int Constante que representa el de diciembre
    */
    const MES_DICIEMBRE = 12;
    /**
     *
     * @var array Arreglo que contiene los meses del año
     */
    public static $months = [
        self::MES_ENERO         => 'Enero',
        self::MES_FEBRERO       => 'Febrero',
        self::MES_MARZO         => 'Marzo',
        self::MES_ABRIL         => 'Abril',
        self::MES_MAYO          => 'Mayo',
        self::MES_JUNIO         => 'Junio',
        self::MES_JULIO         => 'Julio',
        self::MES_AGOSTO        => 'Agosto',
        self::MES_SEPTIEMBRE    => 'Septiembre',
        self::MES_OCTUBRE       => 'Octubre',
        self::MES_NOVIEMBRE     => 'Noviembre',
        self::MES_DICIEMBRE     => 'Diciembre',
    ];
    
    /**
    * @const int Constante que representa el primer trimestre del año
    */
    const PRIMER_TRIMESTRE = 1;
    /**
    * @const int Constante que representa el segundo trimestre del año
    */
    const SEGUNDO_TRIMESTRE = 2;
    /**
    * @const int Constante que representa el tercer trimestre del año
    */
    const TERCER_TRIMESTRE = 3;
    /**
    * @const int Constante que representa el cuarto trimestre del año
    */
    const CUARTO_TRIMESTRE = 4;
    /**
     *
     * @var array Arreglo que contiene los meses del año
     */
    public static $trimesters = [
        self::PRIMER_TRIMESTRE       => '1er. Trimestre',
        self::SEGUNDO_TRIMESTRE      => '2do. Trimestre',
        self::TERCER_TRIMESTRE       => '3er. Trimestre',
        self::CUARTO_TRIMESTRE       => '4to. Trimestre',
    ];
    
    public function __construct() {}
    
    /**
     * 
     * @param mixed $tipo
     * @param string $titulo
     * @param string $mensaje
     * @return array
     */
    public static function getAlert($tipo,$titulo,$mensaje){
        return ["tipo"=>$tipo,"titulo"=>$titulo,"mensaje"=>$mensaje];
    } 
    
    /**
     * 
     * @param string $date
     * @param string $format [optional]
     * @param \DateTimeZone $datetime_zone [optional]
     * @return \DateTime
     */
    public static function createDateTimeObject($date,$format='d/m/Y',$datetime_zone=null) {
        if($datetime_zone===null)
            $datetime_zone = new \DateTimeZone(config('app.timezone'));
        try {
            return \DateTime::createFromFormat($format,$date,$datetime_zone);
        }
        catch(Excetpion $ex) {
            return null;
        }
    }
    
    /**
     * Colorea el monto según sea la cifra
     * 
     * @param double $saldo
     * @param boolean $fixed [optional]
     * @param boolean $sign [optional]
     * @return string
     */
    public static function colorearSaldo($saldo,$fixed=true,$sign=false) {
        $str = "<span class=':color'>".(($sign && $saldo>=0)?"+":"").":saldo</span>";
        if($saldo>=0)
            $str = str_replace(':color','color-good',$str);
        else
            $str = str_replace(':color','color-remove',$str);
        return str_replace(':saldo',(($fixed)?number_format($saldo,2,',','.'):$saldo),$str);
    }
    
    /**
     * Colorea el monto según sea la cifra
     * 
     * @param double $saldo
     * @param double $valor
     * @param boolean $fixed [optional]
     * @param boolean $sign [optional]
     * @return string
     */
    public static function colorearSaldoExacto($saldo,$valor,$fixed=true,$sign=false) {
        $str = "<span class=':color'>".(($sign && $saldo==$valor)?"+":"").":saldo</span>";
        if($saldo==$valor)
            $str = str_replace(':color','color-good',$str);
        else
            $str = str_replace(':color','color-remove',$str);
        return str_replace(':saldo',(($fixed)?number_format($saldo,2,',','.'):$saldo),$str);
    }
    
    /**
     * Generate a code with the parameters provided
     * @param int $key Key for selection
     * @param int $length The length of the string generated
     * @return mixed Returns the generated string or null if the key doesn't exists
     **/ 
    public static function generateCode($key,$length) {
        $code = "";
        for($i = 0; $i < $length; $i++) {
            $code .= substr(self::$BOXES[$key],rand(0,strlen(self::$BOXES[$key])),1);
        }
        return $code;
    }
    
    /**
     * Get the extension for the name provided
     * @param string $name The filename to get the extension
     * @return string Return the extension filename.
     **/
    public static function getExtension($name) {
        $array = explode(".",$name);
        return end($array);
    }
    
    /**
     * 
     * @param numeric $number
     * @param numeric $default
     * @return numeric
     */
    public static function getWithDefault($number,$default) {
        if(!$number)
            return $default;
        return $number;
    }
    
    /**
     * This function returns a DateTime object with the first day in the week
     * from the gived date. This date starts at sunday.
     * @param \DateTime $date Date to process
     * @return \DateTime Returns the first day in week
     **/ 
    public static function placeFirstDay($date,$days_representations=null) {
        if($days_representations==null)
            $days_representations = self::$DAYS_REPRESENTATIONS;
        $date_representation = 0-$days_representations[$date->format("D")];
        $date_interval = new DateInterval("P".abs($date_representation)."D");
        return $date->sub($date_interval);
    }
    
    /**
     * This function calculates the min and max date which represents a week
     * for the gived date. This week starts the sunday thought saturday
     * @param \DateTime $date Date to process
     * @return array Returns an array with the min and max date
     **/ 
    public static function getWeekRangeForDate($date,$days_representations=null) {
        $date_min = self::placeFirstDay($date,$days_representations);
        $date_max = new DateTime($date->format("Y-m-d"),$date->getTimezone());
        $date_interval = new DateInterval("P6D");
        return array("DateMin" => $date_min, "DateMax" => $date_max->add($date_interval));
    }
    
}