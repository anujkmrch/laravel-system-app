<?php
namespace Dsu\Traits;

trait Coursable
{
	/**
     * Generate formConfiguration for widget editing
     * @return [type] [description]
     */
    public function renderingConfiguration()
    {
        if($this->formConfiguration == null):
            $keys = config('dsu.course',[]);
            foreach($keys as $key => $configuration):
                if(array_key_exists('scope', $configuration)):
                    $scope = $configuration['scope'];
                    $configuration['widget_id'] = $this->id;
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


    /**
    * Save the course item from request object, whether it is new or old
    * @param  [type] $data [description]
    * @return [type]       [description]
    */
    public function setCourseData($data)
    {
        foreach($data as $key => $value)
        {
            $this->$key = $value;
        }
    }



    public function saveRelations($relations)
    {
	    $configuration = config('dsu.course',[]);
        // dd($configuration,$relations);
        foreach($configuration as $config => $item):
        	if(!array_key_exists($config, $relations) and $item['scope']==='relation'){
        		// dd($configuration[$config]);
        		if(array_key_exists('builder_method', $configuration[$config])
                )
                {
                    $builder = $configuration[$config]['builder_method'];
                    if($builder === 'sync'):
                            $value = [];
                    endif;
                    $this->$config()->$builder($value);
                }
        	}
        endforeach;

        //need to execute 2d array
        foreach($relations as $type => $relation)
        {
            foreach($relation as $key => $value)
            {
                if($type === $configuration[$key]['builder'] 
                    and $type === 'default' 
                    and array_key_exists('builder_method', $configuration[$key])
                )
                {
                    $builder = $configuration[$key]['builder_method'];
                    if($builder === 'sync'):

                        if(!is_array($value))
                            $value = [];

                        // // check if we have to put it on every menu, if so 
                        // // remove other multiple menu and make it available
                        // // to every menu
                        // if(in_array(0,$value))
                        //     $value = [0];
                    endif;
                    $this->$key()->$builder($value);
                }
            }
        }
        return;
    }

    public static function extractors($data,$requested){
    $columns = [];
      $relations = [];
      foreach($data as $key => $configuration)
      {
        if(!array_key_exists('scope', $configuration))
          continue;

        $scope = 'extract'.ucfirst($configuration['scope']);
        // if(array_key_exists($key, $requested) and method_exists(__CLASS__, $scope))
        
      if(array_key_exists($key, $requested))
        {
          $scope = $configuration['scope'];
          switch($scope){
            case 'column':
              if($key!=='configuration')
                $columns[$key] = $requested[$key];
            break;

            case 'configuration':
              $columns['configuration'][$key] = $requested[$key];
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
      }
      return (['columns'=>$columns,'relations'=>$relations]);
  }
}

?>