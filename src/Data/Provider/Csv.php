<?php
namespace przemeko\Statistics\Data\Provider;

use przemeko\Statistics\Data\DataProviderInterface;
use przemeko\Statistics\Data\Exception\IOException;

/**
 * Csv 
 * 
 * @uses DataProviderInterface
 */
class Csv implements DataProviderInterface
{
    /**
     * fileHandler 
     * 
     * @var mixed
     */
    private $fileHandler;

    /**
     * delimiter 
     * 
     * @var string
     */
    private $delimiter = ',';

    /**
     * enclosure 
     * 
     * @var string
     */
    private $enclosure = '"';

    /**
     * __construct 
     * 
     * @param string $filename 
     * @throws \przemeko\Statistics\DataProvider\Exception\IOException
     */
    public function __construct($filename)
    {
        if (!is_file($filename)) {
            throw new IOException(sprintf("File %s doesn't exits", $filename));
        }

        $this->fileHandler = fopen($filename, "r");

        if (FALSE === $this->fileHandler) {
            throw new IOException(sprintf("Error with loading file %s", $filename));
        }
    }

    /**
     * get 
     * 
     * @return array
     */
    public function get()
    {
        while (!feof($this->fileHandler)) {
            $row = fgetcsv($this->fileHandler, 0, $this->delimiter, $this->enclosure);
            if (false !== $row) {
                yield $row;
            }
        }

        rewind($this->fileHandler);
    }

    /**
     * setDelimiter 
     * 
     * @param mixed $delimiter 
     * @return void
     */
    public function setDelimiter($delimiter)
    {
        $this->delimiter = $delimiter;
        return $this;
    }

    /**
     * setEnclosure 
     * 
     * @param string $enclosure 
     * @return void
     */
    public function setEnclosure($enclosure)
    {
        $this->enclosure = $enclosure;
        return $this;
    }

    public function __destruct()
    {
        if ($this->fileHandler) {
            fclose($this->fileHandler);
        }
    }
}
