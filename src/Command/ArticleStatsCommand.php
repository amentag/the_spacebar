<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ArticleStatsCommand extends Command
{
    protected static $defaultName = 'article:stats';

    protected function configure()
    {
        $this
            ->setDescription('Returns some article stats')
            ->addArgument('slug', InputArgument::REQUIRED, "The article's slug")
            ->addOption('format', null, InputOption::VALUE_REQUIRED, 'The output format', 'text')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $slug = $input->getArgument('slug');

        $data = [
            'slug' => $slug,
            'hearts' => rand(1, 100),
        ];

        switch ($input->getOption('format')) {
            case 'text':
                $io->listing($data);
                break;
            case 'json':
                $io->writeln(json_encode($data));
                break;
            case 'table':
                $io->table(['Key', 'Value'], array_map(function ($slug) use ($data) {
                    return [$slug, $data[$slug]];
                }, array_keys($data)));
                break;
            default:
                throw new \Exception('Unauthorized format');
        }
    }
}
