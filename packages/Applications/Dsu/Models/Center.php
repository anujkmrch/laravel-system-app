<?php

namespace Dsu\Models;

use Illuminate\Database\Eloquent\Model;

class Center extends Model
{

	public function buildCenterFormElement($recreate=false)
    {
        if($this->formConfiguration == null or $recreate):
        $data = config('dsu.center');
        $columns = [];
        $relations = [];
        foreach($data as $key => $configuration)
        {
            if(!array_key_exists('scope', $configuration))
                continue;

            // $scope = 'extract'.ucfirst($configuration['scope']);
            // if(array_key_exists($key, $requested) and method_exists(__CLASS__, $scope))
            
            $scope = $configuration['scope'];
            switch($scope){
                case 'column':
                    if($key!=='configuration')
                        $data[$key]['value'] = $this->$key;
                break;

                case 'configuration':
                    // $columns['configuration'][$key] = $this->$key;
                    $data[$key]['value'] = $this->$key;
                break;

                case 'relation':
                    $builder = 'default';
                    if(array_key_exists('builder', $configuration) 
                        and $configuration['builder'] !== 'default' and !empty($configuration['builder']))
                        $builder = $configuration['builder'];
                        $relations[$builder][$key] = $requested[$key];
                break;
            }
        }
        $this->formConfiguration = $data;
        endif;
        return $this->formConfiguration;
    }

    /**
     * Save the course item from request object, whether it is new or old
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function setCenterData($data)
    {
        foreach($data as $key => $value)
        {
            $this->$key = $value;
        }
    }
}
