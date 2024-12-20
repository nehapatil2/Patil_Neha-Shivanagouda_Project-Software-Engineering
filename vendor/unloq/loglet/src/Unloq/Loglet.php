<?php
namespace Unloq;

use GuzzleHttp\Client;
use GuzzleHttp\Exception;

class Loglet
{
    /**
     * @var string
     */
    protected $name;
    /**
     * @var object
     */
    protected $_client;
    /**
     * Unloq.io logging url
     *
     * @var string
     */
    protected $_url = 'https://stream.loglet.io/application/log';

    /**
     * Contains the level of logging as defined in loglet.io
     *
     * @var array
     */
    protected $levels = [
        'TRACE',
        'DEBUG',
        'INFO',
        'WARN',
        'ERROR',
        'FATAL'
    ];

    /**
     * Headers required for logging request sent to unloq.io
     *
     * @var array
     */
    protected $_headers;

    public function __construct($name, $key)
    {
        $this->name = $name;

        $this->_headers = [
            'Authorization' =>  'Bearer ' . $key,
        ];

        $this->_client = new Client();
    }

    /**
     * Saves data to loglet.io, through a POST request.
     *
     * @param $message
     * @param $level
     * @param array $details
     *
     * @return array
     */
    public function log($message, $level, array $details)
    {
        if(array_search($level, $this->levels) === false)
            throw new \InvalidArgumentException('Level "' . $level .'" not defined. Use of of : ' . implode(',', $this->levels));

        if(count($details) == 0)
            throw new \InvalidArgumentException('Please provide details to be logged');

        $data = [
            'headers' => $this->_headers,
            'json' => [
                'name' => $this->name,
                'level' => $level,
                'message' => $message,
                'data' => $details
            ],
        ];

        try {
            $request = $this->_client->request('POST', $this->_url, $data);
            return [
                'code' => $request->getStatusCode(),
                'message' => json_decode($request->getBody()->getContents())
            ];
        } catch (Exception\ClientException $e) {
            return [
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ];
        } catch (Exception\ServerException $e) {
            return [
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ];
        }
    }
}