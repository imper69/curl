<?php
/**
 * Copyright: IMPER.INFO Adrian Szuszkiewicz
 * Date: 22.06.17
 * Time: 16:22
 */

namespace Imper69\Curl;


use Imper69\Curl\Model\ResponseInterface;

interface CurlClientInterface
{
    /**
     * Sets the URL which will be treated as prefix for every next request. Example:
     * You set baseUrl as "http://test123.com/apiEndpoint/v1" and GET uri "/resource/product/123123"
     * library will call merged URL from above parts.
     *
     * @param string $baseUrl
     */
    public function setBaseUrl(string $baseUrl): void;

    /**
     * Sets HTTP request header. This will be used with every next request
     *
     * @param string $key
     * @param string $value
     */
    public function setHeader(string $key, string $value): void;

    /**
     * Sets header for http basic auth. This will be used with every next request
     *
     * @param string $username
     * @param string $password
     */
    public function setBasicAuthentication(string $username, string $password = ''): void;

    /**
     * POST request
     *
     * @param string$url
     * @param array $data
     * @param bool $follow_303_with_post
     * @return ResponseInterface|null
     */
    public function post(string $url, array $data = array(), bool $follow_303_with_post = false): ?ResponseInterface;

    /**
     * PUT request
     *
     * @param string $url
     * @param array $data
     * @return ResponseInterface|null
     */
    public function put(string $url, array $data = array()): ?ResponseInterface;

    /**
     * GET request
     *
     * @param string $url
     * @param array $data
     * @return ResponseInterface|null
     */
    public function get(string $url, $data = array()): ?ResponseInterface;

    /**
     * DELETE request
     *
     * @param string $url
     * @param array $query_parameters
     * @param array $data
     * @return ResponseInterface|null
     */
    public function delete(string $url, array $query_parameters = array(), array $data = array()): ?ResponseInterface;

    /**
     * HTTP error code (if occured)
     *
     * @return int
     */
    public function getLastErrorCode(): ?int;

    /**
     * HTTP error message (if occured)
     *
     * @return string
     */
    public function getLastErrorMessage(): ?string;

    /**
     * Returns last response
     *
     * @return ResponseInterface|null
     */
    public function getLastResponse(): ?ResponseInterface;

    /**
     * Returns last raw response
     *
     * @return mixed
     */
    public function getLastRawResponse();

    /**
     * Returns last request data
     *
     * @return mixed
     */
    public function getLastRequestData();

    /**
     * Returns last request url.
     *
     * @return string
     */
    public function getLastRequestUrl(): string;
}