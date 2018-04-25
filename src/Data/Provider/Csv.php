<?php

namespace przemeko\Statistics\Data\Provider;

use przemeko\Statistics\Data\DataProviderInterface;
use przemeko\Statistics\Data\Exception\IOException;

/**
 * @uses DataProviderInterface
 */
class Csv implements DataProviderInterface
{
    /**
     * @var mixed
     */
    private $fileHandler;

    /**
     * @var string
     */
    private $delimiter = ',';

    /**
     * @var string
     */
    private $enclosure = '"';

    /**
     * @throws IOException
     */
    public function __construct(string $filename)
    {
        if (!is_file($filename)) {
            throw new IOException(sprintf("File %s doesn't exits", $filename));
        }

        $this->fileHandler = fopen($filename, "r");

        if (FALSE === $this->fileHandler) {
            throw new IOException(sprintf("Error with loading file %s", $filename));
        }
    }

    public function get(): \Generator
    {
        while (!feof($this->fileHandler)) {
            $row = fgetcsv($this->fileHandler, 0, $this->delimiter, $this->enclosure);
            if (false !== $row) {
                yield $row;
            }
        }

        rewind($this->fileHandler);
    }

    public function setDelimiter(string $delimiter): Csv
    {
        $this->delimiter = $delimiter;

        return $this;
    }

    public function setEnclosure(string $enclosure): Csv
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
