<?php

namespace App\Console\Commands;

use App\Faq;
use App\FaqCategory;
use Illuminate\Console\Command;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Finder\Finder;

class GenerateFaqCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'faq:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates the FAQ database entries from the FAQ files in the resources directory.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->truncateFaqs();

        foreach ($this->getFaqFiles() as $file) {
            $category = FaqCategory::create([
                'name' => $file['category-name']
            ]);

            foreach ($file['faqs'] as $item) {
                Faq::create(array_merge([
                    'category' => $category->id
                ], $item));
            }
        }

        $this->info(sprintf('%d categories with %d FAQ items have been generated successfully.',
            FaqCategory::count(),
            Faq::count()
        ));
    }

    /**
     * Truncates the FAQ and the FAQ Categories tables.
     *
     * @return void
     */
    protected function truncateFaqs()
    {
        Faq::truncate();
        FaqCategory::truncate();
    }

    /**
     * Gets the ordered list of valid FAQ files as an array.
     *
     * @return array
     */
    protected function getFaqFiles()
    {
        $faqFiles = [];
        $finder = new Finder();

        foreach ($finder->files()->in(resource_path('faq')) as $file) {
            $yaml = Yaml::parse(file_get_contents($file->getRealPath()));

            if ($this->isValidFaqFile($yaml)) {
                $faqFiles[] = $yaml;
            }
        }

        return collect($faqFiles)->sortBy('category-priority');
    }

    /**
     * Checks if the given YAML array is a valid FAQ file format.
     *
     * @param  array  $yaml
     * @return boolean
     */
    protected function isValidFaqFile($yaml)
    {
        if (! array_key_exists('category-name', $yaml)) {
            return false;
        }

        if (! array_key_exists('category-priority', $yaml)) {
            return false;
        }

        if (! array_key_exists('faqs', $yaml) || ! is_array($yaml['faqs'])) {
            return false;
        }

        foreach ($yaml['faqs'] as $item) {
            if (! array_key_exists('title', $item) || ! array_key_exists('body', $item)) {
                return false;
            }
        }

        return true;
    }
}
