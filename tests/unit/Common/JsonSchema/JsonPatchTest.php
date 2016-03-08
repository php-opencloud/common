<?php

namespace OpenCloud\Test\Common\JsonSchema;

use OpenCloud\Common\JsonSchema\JsonPatch;
use OpenCloud\Test\TestCase;

class JsonPatchTest extends TestCase
{
    public function testAll()
    {
        $fixtures = json_decode(file_get_contents(__DIR__ . '/Fixtures/jsonPatchTests.json'));

        foreach ($fixtures as $fixture) {
            if (isset($fixture->disabled) || !isset($fixture->expected)) {
                continue;
            }

            $actual = JsonPatch::diff($fixture->doc, $fixture->expected);

            $this->assertEquals(
                json_encode($fixture->patch, JSON_UNESCAPED_SLASHES),
                json_encode($actual, JSON_UNESCAPED_SLASHES),
                isset($fixture->comment) ? sprintf("Failed asserting test: %s\n", $fixture->comment) : ''
            );
        }
    }
}