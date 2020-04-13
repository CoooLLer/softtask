<?php

namespace App\Command;

use App\Entity\ProductProperties;
use App\Repository\ProductRepository;
use App\Service\ParseProductTitleToPropertiesService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ParsePropertiesCommand extends Command
{
    protected static $defaultName = 'app:parseProperties';
    private $productRepository;
    private $parseService;
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(ProductRepository $productRepository, ParseProductTitleToPropertiesService $parseService, EntityManagerInterface $manager, string $name = null)
    {
        parent::__construct($name);
        $this->productRepository = $productRepository;
        $this->parseService = $parseService;
        $this->manager = $manager;
    }

    protected function configure()
    {
        $this
            ->setDescription('Parse product titles to properties')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $products = $this->productRepository->findAll();

        $correctCount = 0;
        $incorrectCount = 0;

        foreach ($products as $product) {
            $this->manager->persist($product);
            if ($product->getProperties() === null) {
                $product->setProperties(new ProductProperties());
            }
            $this->parseService->parse($product);

            if ($product->getIsCorrectTitle()) {
                $io->text(sprintf('Produt title: %s is correct', $product->getTitle()));
                $correctCount++;
            } else {
                $io->text(sprintf('Produt title: %s is INcorrect', $product->getTitle()));
                $incorrectCount++;
            }
        }
        $this->manager->flush();

        $io->success(sprintf('Finished! Correct titles: %d, incorrect titles: %d', $correctCount, $incorrectCount));

        return 0;
    }
}
