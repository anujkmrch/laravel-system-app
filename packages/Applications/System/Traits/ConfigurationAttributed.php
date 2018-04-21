<?php
namespace System\Traits;

trait ConfigurationAttributed {
	function getConfiguration($key,$default=null)
    {
    	if(is_null($this->configuration))
    	{
    		return $default;
    	}
    	if(is_string($this->configuration))
    	{
    		$this->configuration = json_decode($this->configuration,true);
    	}
    	if(is_array($this->configuration) and array_key_exists($key, $this->configuration))
    		return  $this->configuration[$key];
        
    	return $default;
    }

    function hasConfiguration($key)
    {
        if(is_null($this->configuration))
        {
            return false;
        }
        if(is_string($this->configuration))
        {
            $this->configuration = json_decode($this->configuration,true);
        }
        if(is_array($this->configuration) and array_key_exists($key, $this->configuration))
            return  true;
        return false;
    }

    function setConfigurationAttribute($value)
    {
        if(is_array($value))
            $this->attributes['configuration'] = json_encode($value);
    }

    function getConfigurationAttribute($value)
    {
        if(is_null($value) or empty($value))
        {
            return [];
        }
        if(is_string($value))
        {
            $value = json_decode($value,true);
        }
       return $value;
    }

    public function setColumns($columns)
    {        
        foreach($columns as $column => $value)
        {
            if(is_array($value) or is_object($value))
                $value = json_encode($value);
            // if($column==='configuration')
            // dd(/$value,$column);
            $this->$column = $value;
        }
    }

    /**
     * Generate formConfiguration for widget editing
     * @return [type] [description]
     */
    public function renderingConfiguration()
    {
        if($this->formConfiguration == null):
            $keys = array_merge($this->configuration,config('news.news',[]));
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
                                $keys[$key]['value'] = $this->$key;
                                if(is_callable($configuration['extractor']))
                                    $keys[$key]['value'] = $configuration['extractor']($keys[$key]['value'],$configuration);
                            endif;
                            
                            // if(is_callable($configuration['builder']))
                            //  $keys[$key]['value'] = $configuration['builder']();

                            // if(is_callable($configuration['extractor']))
                            //  $keys[$key]['value'] = $configuration['extractor']($keys[$key]['value'],$configuration);
                            
                            
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