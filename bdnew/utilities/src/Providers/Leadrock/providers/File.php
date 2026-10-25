<?php
namespace Leadrock\Providers;

class File extends Provider
{
    private $path;
    private $handler;

    public function __construct($filePath)
    {
        $this->path = $filePath;
    }

    /**
     * Lead request from storage by provided ID
     *
     * @param $endpoint
     * @param $id
     * @return mixed|null
     */
    public function readById($endpoint, $id)
    {
        $resource = fopen($this->path, 'r');
        while ($line = fgets($resource)) {
            $data = json_decode($line, true);
            if ($data['id'] == $id) {
                return $data;
            }
        }
        fclose($resource);
        return null;
    }

    /**
     * Lead request from storage by provided ID
     *
     * @param $endpoint
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function readAll($endpoint, $limit = 10, $offset = 0)
    {
        $list = [];
        $resource = fopen($this->path, 'r');
        while ($line = fgets($resource)) {
            if ($offset-- > 0) {
                continue;
            }
            $list[] = json_decode($line, true);
            if (--$limit <= 0) {
                break;
            }
        }
        fclose($resource);
        return $list;
    }

    /**
     * Send data to lead storage
     *
     * @param $endpoint
     * @param $data
     * @return string
     */
    protected function write($endpoint, $data)
    {
        $this->handler = fopen($this->path, 'a');
        $line = [
            'ep' => $endpoint,
            'time' => date('d.m H:i:s')
        ];
        foreach ($data as $param => $value) {
            $line[$param] = $value;
        }
        fwrite($this->handler, json_encode($line) . "\r\n");
        fclose($this->handler);

        return null;
    }

    public function close()
    {
        if (!empty($this->handler) && is_resource($this->handler) && in_array(get_resource_type($this->handler), ['stream', 'file'])) {
            fclose($this->handler);
            $this->handler = null;
        }
    }

    protected function preSaveRequest($trackId, $userIp, $userAgent)
    {
        // none
    }
}