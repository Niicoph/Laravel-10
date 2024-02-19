<x-layout>
    <x-breadcrumbs class="mb-4" :links="['Jobs' => route('jobs.index') , $job->title => '#']"></x-breadcrumbs>
    <x-job-card :$job></x-job-card>
</x-layout>