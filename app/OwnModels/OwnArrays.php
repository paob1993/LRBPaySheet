<?php

namespace App\OwnModels;

/**
 * Description of OwnArrays
 *
*/

class OwnArrays {

    /**
     * @const int Constante que representa el número de semanas para los recibos
    */
    const NUMERO_DE_SEMANAS_MES = 4;

    /**
     * @const int Constante que representa el número de horas semanales en un recibo para un trabajador de tiempo completo
    */
    const NUMERO_DE_HORAS_SEMANALES = 40;

    /**
     * @const int Constante que representan al Empleado Administrativo
    */
    const EMPLEADO_ADMINISTRATIVO = 1;

	/**
     * @const int Constante que representan al Empleado Obrero
    */
    const EMPLEADO_OBRERO = 2;

	/**
     * @const int Constante que representan al Empleado Docente
    */
    const EMPLEADO_DOCENTE = 3;
     
    /**
     * Arreglo con los tipos de empleados
     *
     * @var array 
    */
    public static $tipos_empleados = [
        self::EMPLEADO_ADMINISTRATIVO => 'Administrativo',
        self::EMPLEADO_OBRERO => 'Obrero',
        self::EMPLEADO_DOCENTE => 'Docente',
    ];

    public static $tipos_empleados_value = [
        self::EMPLEADO_ADMINISTRATIVO => 'adm',
        self::EMPLEADO_OBRERO => 'obr',
        self::EMPLEADO_DOCENTE => 'doc',
    ];


    /**
     * @const int Constante que representa al Personal Directivo
    */
    const PERSONAL_DIRECTIVO = 1;

    /**
     * @const int Constante que representa al Personal Docente de Preescolar
    */
    const PERSONAL_DOCENTE_DE_PREESCOLAR = 2;

    /**
     * @const int Constante que representa al Personal Docente de Básica
    */
    const PERSONAL_DOCENTE_DE_BASICA = 3;

    /**
     * @const int Constante que representa al Personal Docente de Básica y Diversificada
    */
    const PERSONAL_DOCENTE_DE_BASICA_Y_DIVERSIFICADO = 4;

    /**
     * @const int Constante que representa al Personal de Bienestar Estudiantil
    */
    const PERSONAL_BIENESTAR_ESTUDIANTIL = 5;

    /**
     * @const int Constante que representa al Personal Administrativo
    */
    const PERSONAL_ADMINISTRATIVO = 6;

    /**
     * @const int Constante que representa al Personal Obrero
    */
    const PERSONAL_OBRERO = 7;

    /**
     * Arreglo con los tipos de personal (Estructura de Costos)
     *
     * @var array 
    */
    public static $tipos_de_personal = [
        self::PERSONAL_DIRECTIVO => 'Directivo',
        self::PERSONAL_DOCENTE_DE_PREESCOLAR => 'Docente Preescolar',
        self::PERSONAL_DOCENTE_DE_BASICA => 'Docente de Básica 1º-6º',
        self::PERSONAL_DOCENTE_DE_BASICA_Y_DIVERSIFICADO => 'Docente de Básica 7º-9º y Diversificado',
        self::PERSONAL_BIENESTAR_ESTUDIANTIL => 'Bienestar Estudiantil',
        self::PERSONAL_ADMINISTRATIVO => 'Administrativo',
        self::PERSONAL_OBRERO => 'Obrero',
    ];

    /**
     * @const int Constante que representan a los docentes Licenciados en Educación
    */
    const LICENCIADO_EN_EDUCACION = 1;

    /**
     * @const int Constante que representan a los docentes Licenciados en Educación con Postgrado
    */
    const LCENCIADO_EN_EDUCACION_POSTGRADO = 2;

    /**
     * @const int Constante que representan a los Profesionales NO Docentes
    */
    const PROFESIONAL_NO_DOCENTE = 3;

    /**
     * @const int Constante que representan a los Profesores Graduados
    */
    const PROFESOR_GRADUADO = 4;

    /**
     * @const int Constante que representan a los Técnicos Superiores Universitarios
    */
    const TECNICO_SUPERIOR_UNIVERSITARIO = 5;

    /**
     * @const int Constante que representan a los docentes Licenciados en Educación con Especialización
    */
    const LICENCIADO_EN_EDUCACION_ESPECIALIZACION = 6;

    /**
     * @const int Constante que representan a los Docentes NO Graduados
    */
    const NO_GRADUADO = 7;

    /**
     * Arreglo que contiene las descripciones de los titulos docentes
     *
     * @var array 
    */
    public static $descripciones_titulos = [
        self::LICENCIADO_EN_EDUCACION => 'Licenciado en Educación',
        self::LCENCIADO_EN_EDUCACION_POSTGRADO => 'Licenciado en Educación/Postgrado',
        self::PROFESIONAL_NO_DOCENTE => 'Profesional No Docente',
        self::PROFESOR_GRADUADO => 'Profesor Graduado',
        self::TECNICO_SUPERIOR_UNIVERSITARIO => 'Técnico Superior Universitario',
        self::LICENCIADO_EN_EDUCACION_ESPECIALIZACION => 'Licenciado en Educación/Especialización',
        self::NO_GRADUADO => 'No Graduado',
    ];

    /**
     *Arreglo que contiene las abreviaturas de los titulos docentes
     *
     * @var array 
    */
    public static $abreviaturas_titulos = [
        self::LICENCIADO_EN_EDUCACION => 'LE',
        self::LCENCIADO_EN_EDUCACION_POSTGRADO => 'LE/P',
        self::PROFESIONAL_NO_DOCENTE => 'PND ',
        self::PROFESOR_GRADUADO => 'PG',
        self::TECNICO_SUPERIOR_UNIVERSITARIO => 'TSU',
        self::LICENCIADO_EN_EDUCACION_ESPECIALIZACION => 'PG/E',
        self::NO_GRADUADO => 'NG',
    ];


    /**
     * @const int Constante que representa el nivel de instrucción Bachiller
    */
    const NIVEL_NO_BACHILLER = 1;

    /**
     * @const int Constante que representa el nivel de instrucción Bachiller
    */
    const NIVEL_BACHILLER = 2;
      
    /**
     * @const int Constante que representa el nivel de instrucción Tsu
    */
    const NIVEL_TSU = 3;
      
    /**
     * @const int Constante que representa el nivel de instrucción Licenciado
    */
    const NIVEL_LICENCIADO = 43;

    /**
     *
     * @var array Arreglo que contiene los niveles de instrucción del modelo
    */
    public static $niveles_instruccion = [
        self::NIVEL_NO_BACHILLER => 'No Bachiller',
        self::NIVEL_BACHILLER => 'Bachiller',
        self::NIVEL_TSU => 'T.S.U',
        self::NIVEL_LICENCIADO => 'Licenciado'
    ];


    /**
     * @const int Constate que representan el tipo de nómina de Asignación
    */
    const CODIGO_DE_ASIGNACION = 1;

    /**
     * @const int Constate que representan el tipo de nómina de Deducción
    */
    const CODIGO_DE_DEDUCCION = 2;

    /**
     * @const int Constate que representan el tipo de nómina de Retención
    */
    const CODIGO_DE_RETENCION = 3;

    /**
     * @const int Constate que representan el tipo de nómina de Cestaticket
    */
    const CODIGO_DE_CESTATICKET = 4;

    /**
     * @const int Constate que representan el tipo de nómina de Otro
    */
    const CODIGO_DE_OTRO = 5;

    /**
     *
     * @var array Arreglo que contiene los Tipos de Códigos Nóminas
     */
    public static $tipos_nominas = [
        self::CODIGO_DE_ASIGNACION => 'Asignación',
        self::CODIGO_DE_DEDUCCION => 'Deducción',
        self::CODIGO_DE_RETENCION => 'Retención',
        self::CODIGO_DE_CESTATICKET => 'Cestaticket',
        self::CODIGO_DE_OTRO => 'Otro',
    ];


    /**
     * @const int Constante que representa la fórmula del sueldo
    */
    const FORMULA_SUELDO = 1;
      
    /**
     * @const int Constante que representa la fórmula del cestaticket
    */
    const FORMULA_CESTATICKET = 2;
      
    /**
     * @const int Constante que representa la fórmula de las prestaciones sociales
    */
    const FORMULA_PRESTACIONES_SOCIALES = 3;
      
    /**
     * @const int Constante que representa la fórmula del aguinaldo
    */
    const FORMULA_AGUINALDO = 4;
      
    /**
     * @const int Constante que representa la fórmula del bono vacacional
    */
    const FORMULA_BONO_VACACIONAL = 5;

    /**
     *
     * @var array Arreglo que contiene las fórmulas sobre las que trabajan las configuraciones
    */
    public static $formulas = [
        self::FORMULA_SUELDO => 'Salario',
        self::FORMULA_CESTATICKET => 'Cestaticket',
        self::FORMULA_PRESTACIONES_SOCIALES => 'Prestaciones Sociales',
        self::FORMULA_AGUINALDO => 'Aguinaldo',
        self::FORMULA_BONO_VACACIONAL => 'Bono Vacacional'
    ];


    /**
     * @const int Constante que representa el sueldo base
    */
    const BASADO_EN_NO_APLICA = 1;

    /**
     * @const int Constante que representa el sueldo base
    */
    const BASADO_EN_SUELDO_BASE = 2;
      
    /**
     * @const int Constante que representa la antiguedad
    */
    const BASADO_EN_ANTIGUEDAD = 3;
      
    /**
     * @const int Constante que representa el sueldo diario
    */
    const BASADO_EN_SUELDO_DIARIO = 4;
      
    /**
     * @const int Constante que representa el valor por hora
    */
    const BASADO_EN_VALOR_POR_HORA = 5;

    /**
     *
     * @var array Arreglo que contiene las fórmulas sobre las que trabajan las configuraciones
    */
    public static $basados_en = [
        self::BASADO_EN_NO_APLICA => 'No Aplica',
        self::BASADO_EN_SUELDO_BASE => 'Sueldo Base',
        self::BASADO_EN_ANTIGUEDAD => 'Antiguedad',
        self::BASADO_EN_SUELDO_DIARIO => 'Sueldo Diario',
        self::BASADO_EN_VALOR_POR_HORA => 'Valor por Hora',
    ];

    /**
     *
     * @var array Arreglo que contiene las fórmulas sobre las que trabajan las configuraciones
    */
    public static $basados_en_value = [
        self::BASADO_EN_NO_APLICA => 'uds',
        self::BASADO_EN_SUELDO_BASE => '%',
        self::BASADO_EN_ANTIGUEDAD => 'años',
        self::BASADO_EN_SUELDO_DIARIO => 'días',
        self::BASADO_EN_VALOR_POR_HORA => 'horas',
    ];


    /**
     * @const int Constante que representan la configuración de tipo porcentual
    */
    const CONFIGURACION_PORCENTUAL = 1;

    /**
     * @const int Constante que representan la configuración de tipo bolívares
    */
    const CONFIGURACION_BOLIVARES = 2;

    /**
     * @const int Constante que representan la configuración de tipo unidades tributarias
    */
    const CONFIGURACION_UNIDADES_TRIBUTARIAS = 3;

    /**
     * @const int Constante que representan la configuración de tipo horas
    */
    const CONFIGURACION_HORAS = 4;

    /**
     * @const int Constante que representan la configuración de tipo días
    */
    const CONFIGURACION_DIAS = 5;

    /**
     * @const int Constante que representan la configuración de tipo años
    */
    const CONFIGURACION_ANOS = 6;

    /**
     * @const int Constante que representan la configuración de tipo otro
    */
    const CONFIGURACION_OTRO = 7;

    /**
     *
     * @var array Arreglo que contiene los Tipos de Códigos Nóminas
     */
    public static $tipos_valor = [
        self::CONFIGURACION_PORCENTUAL => '%',
        self::CONFIGURACION_BOLIVARES => 'Bs',
        self::CONFIGURACION_UNIDADES_TRIBUTARIAS => 'UT',
        self::CONFIGURACION_HORAS => 'Horas',
        self::CONFIGURACION_DIAS => 'Días',
        self::CONFIGURACION_ANOS => 'Años',
        self::CONFIGURACION_OTRO => 'Otro',
    ];

      
    /**
     * @const int Constante que representa el requerimiento de Postgrado
    */
    const REQUIERE_NINGUNO = 1;
    /**
     * @const int Constante que representa el requerimiento de TSU
    */
    const REQUIERE_TSU = 2;
      
    /**
     * @const int Constante que representa el requerimiento de Licenciatura
    */
    const REQUIERE_LICENCIADO = 3;
      
    /**
     * @const int Constante que representa el requerimiento de Especializacióm
    */
    const REQUIERE_ESPECIALIZACION = 4;
      
    /**
     * @const int Constante que representa el requerimiento de Postgrado
    */
    const REQUIERE_POSTGRADO = 5;

    /**
     *
     * @var array Arreglo que contiene los requerimientos de una prima
    */
    public static $requiere_prima = [
        self::REQUIERE_NINGUNO => 'No Aplica',
        self::REQUIERE_TSU => 'T.S.U',
        self::REQUIERE_LICENCIADO => 'Licenciado',
        self::REQUIERE_ESPECIALIZACION => 'Especialización',
        self::REQUIERE_POSTGRADO => 'Postgrado'
    ];

    public static $requiere_prima_value = [
        self::REQUIERE_NINGUNO => 'none',
        self::REQUIERE_TSU => 'tsu',
        self::REQUIERE_LICENCIADO => 'lcdo',
        self::REQUIERE_ESPECIALIZACION => 'esp',
        self::REQUIERE_POSTGRADO => 'post'
    ];


    /**
     * @const int Constante que representa el registro nómina de tipo automático
    */
    const TIPO_AUTOMATICO = 1;
      
    /**
     * @const int Constante que representa el registro nómina de tipo manual
    */
    const TIPO_MANUAL = 2;
      
    /**
     * @const int Constante que representa el registro nómina de otro tipo
    */
    const OTRO_TIPO = 3;

    /**
     *
     * @var array Arreglo que contiene los niveles de instrucción del modelo
    */
    public static $tipos_registros_nomina = [
        self::TIPO_AUTOMATICO => 'Automático',
        self::TIPO_MANUAL => 'Manual',
        self::OTRO_TIPO => 'Otro'
    ];

}