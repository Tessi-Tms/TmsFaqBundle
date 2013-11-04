<?php

namespace Tms\Bundle\FaqBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class BuildFaqSearchIndexCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('tms:faq:build-search-index');
        $this->setDescription('Build lucene search index for the Faq.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>Build lucene search index...</info>');
        $k = 0;

        $indexer = $this->getContainer()->get('tms_faq.indexer');

        $questions = $this
            ->getContainer()
            ->get('tms_faq.manager.question')
            ->findAll()
        ;

        foreach($questions as $question) {
            $output->writeln(sprintf(
                '<info>%d > Build index for question (#%d)</info>',
                ++$k,
                $question->getId()
            ));
            $indexer->add($question);
        }

        $indexer->write();

        $output->writeln(sprintf(
            '<info>The lucene search index is now up to date, %d questions processed</info>',
            $k
        ));
     }
}
