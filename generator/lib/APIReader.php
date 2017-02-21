<?php
/*
 * This file is part of the CloudStack Client Generator.
 *
 * (c) Quentin Pleplé <quentin.pleple@gmail.com>
 * (c) Aaron Hurt <ahurt@anbcs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class APIReader
{
    protected $lib;
    protected $config;
    protected $extension;
    protected $responseTypeHash;

    function __construct($lib)
    {
        $this->lib = $lib;
        $this->config = $lib->config;
        $this->responseTypeHash = array();
        if ($this->config['language'] == "php") {
            $this->extension = "php";
        } elseif ($this->config['language'] == "python") {
            $this->extension = "py";
        } else {
            throw new Exception("Language " . $this->config['language'] . " not supported.");
        }
    }

    public function dumpMethodData($method)
    {
        $methods = $this->fetchApiData();
        if (isset($methods[$method])) {
            var_dump($this->getMethodData($methods[$method]));
        } else {
            print "Unknown Method!\n";
        }
    }

    public function dumpMethod($method)
    {
        $methods = $this->fetchApiData();
        if (isset($methods[$method])) {
            $this->lib->render("method." . $this->extension . ".twig", array(
                "method" => $this->getMethodData($methods[$method]),
                "config" => $this->config,
            ));
        }
    }

    public function dumpMethodNames()
    {
        $methods = $this->fetchApiData();
        foreach ($methods as $method) {
            printf("%s - %s\n", $method->name, $method->description);
        }
    }

    public function dumpClass()
    {
        $methods = $this->fetchApiData();
        $methodsData = array();

        // walk through all links
        foreach ($methods as $method) {
            $methodsData[] = $this->getMethodData($method);
        }

        $this->lib->render("class." . $this->extension . ".twig", array(
            "methods" => $methodsData,
            "config" => $this->config,
        ));
    }

    public function dumpResponse()
    {

        $methods = $this->fetchApiData();
        $template = "response." . $this->extension . ".twig";
        // make a copy of the hash to get the intermediate class definitions
        $t = $this->lib->getTwig()->loadTemplate($template);
        foreach ($methods as $method) {
            $methodData = $this->getResponseData($method);
            $className = $methodData['className'];
            $templateData = $t->render(
                    array(
                        'className' => $className,
                        'response' => $methodData['memberVariables'],
                        'config' => $this->config
                    ));
            $filename = $className . '.php';
            $this->writeResponseFile($filename, $templateData);

        }
        $classes = $this->responseTypeHash;

        foreach ($classes as $className => $memberVariables) {
            if (substr($className, -8) != "Response") {
                $templateData = $t->render(
                    array(
                        'className' => $className,
                        'response' => $memberVariables,
                        'config' => $this->config
                    )
                );
                $filename = $className . '.php';
                $this->writeResponseFile($filename, $templateData);
            }
        }

    }

    protected function writeResponseFile($fileName, $data) {
        $path = $this->config['response_dir'];
        $fullPath = $path . '/' . $fileName;
        return file_put_contents($fullPath, $data);
    }

    public function getMethodData($raw)
    {
        $data = array(
            'name' => trim($raw->name),
            'description' => trim($raw->description),
            'required' => 0,
            'optional' => 0,
            'params' => array()
        );

        // loop through paramaters
        foreach($raw->params as $param) {
            // increase counts
            if ($param->required == true) {
                $data['required']++;
            } else {
                $data['optional']++;
            }
            // special case for missing descriptions
            switch ($param->name) {
                case "pagesize":
                    $param->description = "the number of entries per page";
                break;
                case "page":
                    $param->description = "the page number of the result set";
                break;
            }
            // build paramater data
            $data['params'][] = array(
                "name" => trim($param->name),
                "description" => trim($param->description),
                "required" => (bool) $param->required,
            );
        }

        return $data;
    }

    public function getResponseData($raw) {
        $name = trim($raw->name);
        $metadata = array();
        $metadata['className'] = $className = $name . "Response";
        if (!isset($this->responseTypeHash[$className])) {
            $this->responseTypeHash[$className] = $this->getResponseDataHelper($raw->response);
        }
        $metadata['memberVariables'] = $this->responseTypeHash[$className];
        return $metadata;
    }

    protected function getResponseDataHelper($responses) {
        $responsemeta = array();
        $params = array();
        foreach ($responses as $response) {
            $val = array();
            if (!property_exists($response, 'name')) {
                // blank objects, why do you exist?
                continue;
            }
            $val['name'] = $name = trim($response->name);
            $val['type'] = $type = trim($response->type);
            $val['description'] = $description = trim($response->description);
            if (isset($params[$name])) {
                // there are dupes, this squashes those
                continue;
            }
            $params[$name] = true;
            if ($type == "set" || $type == "list" || $type == "map" || $type == "responseobject"
                    || $type == "uservmresponse") {
                $type = $val['type'] = "array";
                if (!property_exists($response, 'response')) {
                    $val['class'] = 'string';
                } else {
                    if (!isset($this->responseTypeHash[$name])) {
                        $this->responseTypeHash[$name] = $this->getResponseDataHelper($response->response);
                    }
                    $val['class'] = $name;
                }
            } elseif ($type == "imageformat" || $type == "storagepoolstatus"
                    || $type == "hypervisortype" || $type == "status"
                    || $type == "type" || $type == "scopetype" || $type == "state"
                    || $type == "url" || $type == "uuid") {
                $val['type'] = $type = "string";
            } elseif ($type == "integer" || $type == "long" || $type == "short" || $type == "int") {
                $type = $val['type'] = 'int';
            }
            $responsemeta[] = $val;
        }
        return $responsemeta;
    }


    private function fetchApiData() {
        // Pull API list from CloudStack
        $rawData = $this->lib->cloudstack->request('listApis', array());
        $methodData = array();
        foreach ($rawData as $method) {
            $methodData[$method->name] = $method;
        }
        return $methodData;
    }

}
