<?php 

namespace Src;

class Config {

    public function __construct(array $configs) {
        foreach ($configs as $key => $value) {
            $this->$key = (object) $value;
        }
        return $this->$key;
    }

    public static function load($configs) {
        if( is_string($configs) && is_file($configs) ){
            if( !file_exists($configs) ) {
                throw new \InvalidArgumentException(sprintf(
                    'Arquivo de configuração não existente em "%s', $configs
                ));
            }
            $ext = pathinfo($configs, PATHINFO_EXTENSION);
            switch( $ext ) {
                case 'php':
                    $configs = include $configs;
                    break;
                default:
                    throw new \InvalidArgumentException(sprintf(
                        'Extensão "%s" não suportada', $ext
                    ));
                    break;
            }
        }else if( !is_array($configs) ) {
            throw new \InvalidArgumentException(sprintf(
                'Tipo "%s" não permitido para configurações', gettype($configs)
            ));
        }
        return new self($configs);
    }
}
