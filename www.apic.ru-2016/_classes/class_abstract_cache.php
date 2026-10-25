<?

class abstract_cache
{
    var $_cache_type = 'auto'; // дефолтное значение
    var $_memcache = null;

    function __constructor($options = null)
    {
        $this->Cache($options);
    }

    function Cache($options = null)
    {
        // Проверка поддержки кеш-систем
        $cache_systems = array();

        if (function_exists('eaccelerator_get'))
            $cache_systems[] = 'eaccelerator';

        if (function_exists('apc_fetch'))
            $cache_systems[] = 'apc';

        if (function_exists('xcache_get'))
            $cache_systems[] = 'xcache';

        if (class_exists('Memcache'))
            $cache_systems[] = 'memcache';

        $required_cache = isset($options['cache']) ? $options['cache'] : $this->_cache_type;

        if (count($cache_systems) && $required_cache != 'none')
        {
            if ($required_cache == 'auto')
                $this->_cache_type = array_shift($cache_systems); // первое значение в списке
            else if (in_array($required_cache, $cache_systems))
                $this->_cache_type = $required_cache;
            else
                $this->_cache_type = 'none';
        }
        else
            $this->_cache_type = 'none';

        if ($this->_cache_type == 'memcache')
        {
            $failed = true;

            if (isset($options['memcache']) && is_array($options['memcache']))
            {
                $this->_memcache = new Memcache;

                foreach ($options['memcache'] as $server)
                {
                    if (!is_array($server) || !isset($server['host'])) // host должен быть указан
                        continue;

                    $server['port'] = isset($server['port']) ? (int) $server['port'] : ini_get('memcache.default_port');
                    $server['persistent'] = isset($server['persistent']) ? (bool) $server['persistent'] : true;

                    if ($this->_memcache->addServer($server['host'], $server['port'], $server['persistent']))
                        $failed = false;
                }

                if ($failed)
                    $this->_memcache = null;
            }

            if ($failed)
                $this->_cache_type = 'none';
        }
    }

    function get($key)
    {
        $data = null;

        switch ($this->_cache_type)
        {
            case 'none':
                break;
            case 'eaccelerator':
                $data = eaccelerator_get($key);
                break;
            case 'apc':
                $data = apc_fetch($key);
                break;
            case 'xcache':
                $data = xcache_get($key);
                break;
            case 'memcache':
                $data = $this->_memcache->get($key);
                break;
        }

        return $data;
    }

    function put($key, &$data, $ttl)
    {
        switch ($this->_cache_type)
        {
            case 'none':
                break;
            case 'eaccelerator':
                eaccelerator_put($key, $data, $ttl);
                break;
            case 'apc':
                apc_store($key, $data, $ttl);
                break;
            case 'xcache':
                xcache_set($key, $data, $ttl);
                break;
            case 'memcache':
                // Решение set() проблемы с несколькими серверами.
                // http://www.php.net/manual/ru/function.memcache-set.php#84032
                if (!$this->_memcache->replace($key, $data, MEMCACHE_COMPRESSED, $ttl))
                    $this->_memcache->set($key, $data, MEMCACHE_COMPRESSED, $ttl);

                break;
        }
    }
}

?>