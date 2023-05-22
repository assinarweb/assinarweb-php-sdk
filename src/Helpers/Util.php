<?php

namespace AssinarWeb\Helpers;

use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class Util
{
    /**
     * Função que faz validação de documento CPF
     *
     * @param String $cpf numero do documento da pessoa fisica
     */
    public static function validateCpf(String $cpf)
    {
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        if (!is_numeric($cpf)) {
            $status = false;
        } else {
            $dv_informado = substr($cpf, 9, 2);
            $digito = [];

            for ($i = 0; $i <= 8; ++$i) {
                $digito[$i] = substr($cpf, $i, 1);
            }
            $posicao = 10;
            $soma = 0;

            for ($i = 0; $i <= 8; ++$i) {
                $soma = $soma + $digito[$i] * $posicao;
                $posicao = $posicao - 1;
            }

            $digito[9] = $soma % 11;

            if ($digito[9] < 2) {
                $digito[9] = 0;
            } else {
                $digito[9] = 11 - $digito[9];
            }

            $posicao = 11;
            $soma = 0;

            for ($i = 0; $i <= 9; ++$i) {
                $soma = $soma + $digito[$i] * $posicao;
                $posicao = $posicao - 1;
            }

            $digito[10] = $soma % 11;

            if ($digito[10] < 2) {
                $digito[10] = 0;
            } else {
                $digito[10] = 11 - $digito[10];
            }

            $dv = $digito[9] * 10 + $digito[10];

            if ($dv != $dv_informado) {
                $status = false;
            } else {
                $status = true;
            }
        }

        return $status;
    }

    /**
     * Função que formata valor em moeda brasileira
     *
     * @param Int $valor
     */
    public static function formatRealMoney(Int $valor)
    {
        return number_format($valor, 2, ',', '.');
    }

    /**
     * Função que adiciona uma máscara de telefone em um numero.
     *
     * @param Int $val número do telefone
     */
    public static function addPhoneMask(Int $val)
    {
        $val = preg_replace('/\D/', '', $val);
        if (empty($val)) {
            return '';
        }

        $mask = '(##) ####-####';
        if (\strlen($val) == 11) {
            $mask = '(##) #####-####';
        }

        $maskared = '';
        $k = 0;
        for ($i = 0; $i <= \strlen($mask) - 1; ++$i) {
            if ($mask[$i] == '#') {
                if (isset($val[$k])) {
                    $maskared .= $val[$k++];
                }
            } else {
                if (isset($mask[$i])) {
                    $maskared .= $mask[$i];
                }
            }
        }

        return $maskared;
    }

    /**
     * Função que adiciona uma máscara de telefone em um numero.
     *
     * @param Int $val número do telefone
     */
    public static function addCepMask(Int $val)
    {
        $val = preg_replace('/\D/', '', $val);
        if (empty($val)) {
            return '';
        }

        $mask = '#####-###';
        $maskared = '';
        $k = 0;
        for ($i = 0; $i <= \strlen($mask) - 1; ++$i) {
            if ($mask[$i] == '#') {
                if (isset($val[$k])) {
                    $maskared .= $val[$k++];
                }
            } else {
                if (isset($mask[$i])) {
                    $maskared .= $mask[$i];
                }
            }
        }

        return $maskared;
    }

    /**
     * Função que retorna um array com todos os estados do Brasil
     *
     * @return Array
     */
    public static function getBrazilianStates()
    {
        return [
            ['sigla' => 'AC', 'codigo' => '12', 'nomeEstado' => 'Acre'],
            ['sigla' => 'AL', 'codigo' => '27', 'nomeEstado' => 'Alagoas'],
            ['sigla' => 'AP', 'codigo' => '16', 'nomeEstado' => 'Amapá'],
            ['sigla' => 'AM', 'codigo' => '13', 'nomeEstado' => 'Amazonas'],
            ['sigla' => 'BA', 'codigo' => '29', 'nomeEstado' => 'Bahia'],
            ['sigla' => 'CE', 'codigo' => '23', 'nomeEstado' => 'Ceará'],
            ['sigla' => 'DF', 'codigo' => '53', 'nomeEstado' => 'Distrito Federal'],
            ['sigla' => 'ES', 'codigo' => '32', 'nomeEstado' => 'Espírito Santo'],
            ['sigla' => 'GO', 'codigo' => '52', 'nomeEstado' => 'Goiás'],
            ['sigla' => 'MA', 'codigo' => '21', 'nomeEstado' => 'Maranhão'],
            ['sigla' => 'MT', 'codigo' => '51', 'nomeEstado' => 'Mato Grosso'],
            ['sigla' => 'MS', 'codigo' => '50', 'nomeEstado' => 'Mato Grosso do Sul'],
            ['sigla' => 'MG', 'codigo' => '31', 'nomeEstado' => 'Minas Gerais'],
            ['sigla' => 'PA', 'codigo' => '15', 'nomeEstado' => 'Pará'],
            ['sigla' => 'PB', 'codigo' => '25', 'nomeEstado' => 'Paraíba'],
            ['sigla' => 'PR', 'codigo' => '41', 'nomeEstado' => 'Paraná'],
            ['sigla' => 'PE', 'codigo' => '26', 'nomeEstado' => 'Pernambuco'],
            ['sigla' => 'PI', 'codigo' => '22', 'nomeEstado' => 'Piauí'],
            ['sigla' => 'RJ', 'codigo' => '33', 'nomeEstado' => 'Rio de Janeiro'],
            ['sigla' => 'RN', 'codigo' => '24', 'nomeEstado' => 'Rio Grande do Norte'],
            ['sigla' => 'RO', 'codigo' => '11', 'nomeEstado' => 'Rondônia'],
            ['sigla' => 'RS', 'codigo' => '43', 'nomeEstado' => 'Rio Grande do Sul'],
            ['sigla' => 'RR', 'codigo' => '14', 'nomeEstado' => 'Roraima'],
            ['sigla' => 'SC', 'codigo' => '42', 'nomeEstado' => 'Santa Catarina'],
            ['sigla' => 'SP', 'codigo' => '35', 'nomeEstado' => 'São Paulo'],
            ['sigla' => 'SE', 'codigo' => '28', 'nomeEstado' => 'Sergipe'],
            ['sigla' => 'TO', 'codigo' => '17', 'nomeEstado' => 'Tocantins'],
        ];
    }

    /**
     * Função que retorna um array com todos os estados do Brasil pelo IBGE
     *
     * @return Array
     */
    public static function getBrazilianStatesIBGE()
    {
        return [
            'AC' => '12',
            'AL' => '27',
            'AP' => '16',
            'AM' => '13',
            'BA' => '29',
            'CE' => '23',
            'DF' => '53',
            'ES' => '32',
            'GO' => '52',
            'MA' => '21',
            'MT' => '51',
            'MS' => '50',
            'MG' => '31',
            'PA' => '15',
            'PB' => '25',
            'PR' => '41',
            'PE' => '26',
            'PI' => '22',
            'RJ' => '33',
            'RN' => '24',
            'RO' => '11',
            'RS' => '43',
            'RR' => '14',
            'SC' => '42',
            'SP' => '35',
            'SE' => '28',
            'TO' => '17',
        ];
    }

    /**
     * Função que monta uma máscara de acordo com os parâmetro informados
     *
     * @param String $val valor a ser fromatado
     * @param String $mask formato da máscara
     */
    public static function mask(String $val, String $mask)
    {
        $maskared = '';
        $k = 0;
        for ($i = 0; $i <= \strlen($mask) - 1; ++$i) {
            if ($mask[$i] == '#') {
                if (isset($val[$k])) {
                    $maskared .= $val[$k++];
                }
            } else {
                if (isset($mask[$i])) {
                    $maskared .= $mask[$i];
                }
            }
        }

        return $maskared;
    }

    /**
     * Função que monta uma máscara de acordo com os parâmetro informados
     *
     * @param Int $tamanho tramanho da senha
     * @param Bool $maiusculas adicionar caracter
     * @param Bool $numeros adicionar caracter
     * @param Bool $simbolos adicionar caracter
     */
    public static function generatePassword(Int $tamanho = 10, Bool $maiusculas = true, Bool $numeros = true, Bool $simbolos = false)
    {
        $lmin = 'abcdefghijklmnopqrstuvwxyz';
        $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $num = '123456789012345678901234567890';
        $simb = '!@#$%*-';
        $retorno = '';
        $caracteres = '';

        $caracteres .= $lmin;
        if ($maiusculas) {
            $caracteres .= $lmai;
        }
        if ($numeros) {
            $caracteres .= $num;
        }
        if ($simbolos) {
            $caracteres .= $simb;
        }

        $len = \strlen($caracteres);
        for ($n = 1; $n <= $tamanho; ++$n) {
            $rand = mt_rand(1, $len);
            $retorno .= $caracteres[$rand - 1];
        }

        return $retorno;
    }

    /**
     * Função que gera um número qualquer
     *
     * @param Int $tamanho
     */
    public static function generateNumbers($tamanho = 6)
    {
        $num = '123456789012345678901234567890';
        $caracteres = $num;
        $retorno = '';

        $len = \strlen($caracteres);
        for ($n = 1; $n <= $tamanho; ++$n) {
            $rand = mt_rand(1, $len);
            $retorno .= $caracteres[$rand - 1];
        }

        return $retorno;
    }

    /**
     * Função que adiciona máscara em documento do tipo CPF ou CNPJ
     *
     * @param String $documento
     */
    public static function setMaskCpfCnpj(String $documento)
    {
        if (\strlen($documento) < 12) {
            return self::mask($documento, '###.###.###-##');
        }

        return self::mask($documento, '##.###.###/####-##');
    }

    /**
     * Função que remove a máscara em documento do tipo CPF ou CNPJ
     *
     * @param String $documento
     */
    public static function removerMaskCpfCnpj(String $documento)
    {
        return preg_replace('/[^0-9]/', '', trim($documento));
    }

    /**
     * Função que remove a máscara de telefone
     *
     * @param String $number
     */
    public static function removerMaskTel(String $number)
    {
        return preg_replace('/\D/', '', trim($number));
    }

    /**
     * Função que remove a máscara de telefone
     *
     * @param String $number
     */
    public static function removerMaskCep(String $number)
    {
        return preg_replace('/\D/', '', trim($number));
    }

    /**
     * Função que formata data para salvar no banco de dados
     *
     * @param String $number
     */
    public static function numberFormat(String $number)
    {
        if ((substr($number, -3, 1) == ',') || (substr($number, -3, 1) == '.')) {
            $centavos = substr($number, -2);
            $milhar = substr($number, 0, (strlen($number) - 3));
        } elseif ((substr($number, -2, 1) == ',') || (substr($number, -2, 1) == '.')) {
            $centavos = substr($number, -1) . '0';
            $milhar = substr($number, 0, (strlen($number) - 2));
        } elseif ((substr($number, -1) == ',') || (substr($number, -1) == '.')) {
            $centavos = '00';
            $milhar = substr($number, 0, (strlen($number) - 1));
        } else {
            $centavos = '00';
            $milhar = $number;
        }
        $milhar = str_replace('.', '', $milhar);
        $milhar = str_replace(',', '', $milhar);
        $number = $milhar . '.' . $centavos;

        return $number;
    }

    /**
     * Função que elimina as posições valiza do array
     *
     * @param array $data
     */
    public static function clearArray(array $datas)
    {
        foreach ($datas as $key => $data) {
            if (is_null($data)) {
                unset($datas[$key]);
            }
        }

        return $datas;
    }

    public static function objectHasNoProperties(object $object)
    {
        return count(get_object_vars($object)) == 0;
    }

    /**
     * Função que elimina as posições vazias de um objeto
     *
     * @param array|object $data
     */
    public static function ObjectRemovedNull($data)
    {
        if(is_array($data)) {
            foreach($data as $key => $value) {
                $data[$key] = (object) array_filter((array) $value);
            }
        }

        foreach ($data as $key => $value) {
            // The attribute is an object within this object
            if(is_object($value)) {
                foreach($value as $k => $v) {
                    if(is_null($v)) {
                        unset($value->$k);
                    }
                }
                // Removes the attribute that was an object and its attributes have been removed for having null values and it has no properties
                if(self::objectHasNoProperties($value)) {
                    unset($data->$key);
                }
            }
            // If it is a common object it removes all empty attributes
            $data = (object) array_filter((array) $data);
            self::objectHasNoProperties($data) ? $data = null : $data;
        }

        // If it is a common object it removes all empty attributes
        $data = (object) array_filter((array) $data);
        self::objectHasNoProperties($data) ? $data = null : $data;
        return $data;
    }

    public static function normalize(object $data): array
    {
        $serializer = new Serializer([new ObjectNormalizer()]);
        $data = self::clearArray($serializer->normalize($data));

        foreach ($data as $key => $d) {
            if (empty($d)) {
                unset($data[$key]);
            }
        }
        return $data;
    }

}
