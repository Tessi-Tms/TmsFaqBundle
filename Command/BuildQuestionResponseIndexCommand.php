<?php

namespace Tms\Bundle\FaqBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class BuildQuestionResponseIndexCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('tms:faq:build-question-response-index');
        $this->setDescription('Build lucene search index.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>Build lucene search index...</info>');
        $i = 0;
        $k = 0;

        $response_indexer = $this->getContainer()->get('tms_faq.indexer.response');

        $responses = $this
            ->getContainer()
            ->get('tms_faq.manager.response')
            ->findAll()
        ;

        foreach($responses as $response) {
            $output->writeln(sprintf(
                '<info>%d > Build index for "%s" response (#%d)</info>',
                ++$k,
                $response->__toString(),
                $response->getId()
            ));
            $response_indexer->add($response);
        }

        $response_indexer->write();

        $output->writeln(sprintf(
            '<info>The lucene search index is now up to date, %d questions and %d responses processed</info>',
            $i, $k
        ));
     }
}
