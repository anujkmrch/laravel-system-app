<?php
namespace Dsu\Traits;

trait Sessionable
{
	public function renderingConfiguration()
    {
        if($this->formConfiguration == null):
            $keys = config('dsu.session',[]);
            foreach($keys as $key => $configuration):
                if(array_key_exists('scope', $configuration)):
                    $scope = $configuration['scope'];
                    switch($scope):
                        case 'configuration':
                            if($this->hasConfiguration($key)){
                                $keys[$key]['value'] = $this->getConfiguration($key);
                            }
                            // $keys[$key]['value'] = $value;
                            // echo "---{$scope}---{$key}---";
                        break;

                        case 'column':
                            $keys[$key]['value'] = $this->$key;
                        break;

                        case 'relation':
                            if($configuration['builder']==='default'):
                                $keys[$key]['value'] = $this->$key->toArray();
                                if(is_callable($configuration['extractor']))
                                    $keys[$key]['value'] = $configuration['extractor']($keys[$key]['value'],$configuration);
                            endif;
                                                       
                        break;
                    endswitch;
                endif;
            endforeach;
            $this->formConfiguration = $keys;
        endif;
        return $this->formConfiguration;
    }
}

?>