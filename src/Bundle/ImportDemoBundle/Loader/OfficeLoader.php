<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\Import\Bundle\ImportDemoBundle\Loader;

use Endroid\Import\Loader\AbstractLoader;
use XmlIterator\XmlIterator;

class OfficeLoader extends AbstractLoader
{
    /**
     * @var XmlIterator
     */
    protected $iterator;

    /**
     * {@inheritdoc}
     */
    public function initialize()
    {
        $this->state['offices'] = [];

        $this->iterator = new XmlIterator(__DIR__.'/../Resources/data/office_data.xml', 'office');
        $this->iterator->rewind();
    }

    /**
     * {@inheritdoc}
     */
    public function load()
    {
        if (!$this->iterator->valid()) {
            $this->setActive(false);

            return null;
        }

        $item = $this->iterator->current();
        $this->state['offices'][] = $item;
        $this->iterator->next();

        $this->importer->setActiveLoader(AddressLoader::class);

        return $item;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'office_loader';
    }
}
