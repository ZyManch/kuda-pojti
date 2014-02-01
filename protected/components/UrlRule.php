<?php 
class UrlRule extends CBaseUrlRule {

    public function createUrl($manager,$route,$params,$ampersand) {
        $result = array($route);
        if (isset($params['id'])) {
        	$result[] = $params['id'];
        	unset($params['id']);
        }
        $after = '';
        foreach ($params as $key => $param) {
        	if ($key != '#') {
	        	$result[] = $key;
	        	$result[] = $param;
        	} else {
        		$after = '#'.$param;
        	} 
        }
        return implode('/',$result).$after;
    }
 
    public function parseUrl($manager,$request,$pathInfo,$rawPathInfo) {
    	$path = explode('/',$request->getPathInfo());
    	$size = sizeof($path)-2;
    	if ($size > 0) {
    		$r = implode('/', array_splice($path,0,2));
	        if ($size%2 == 1) {
	        	$_GET['id'] = array_shift($path);
	        }
	        for ($i=0, $n=sizeof($path); $i<$n; $i+=2) {
	        	$_GET[$path[$i]] = $path[$i+1];
	        }
	        return $r;
    	}
    	
        return false;
    }
}