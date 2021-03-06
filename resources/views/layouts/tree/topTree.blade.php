<ul class="nav nav-lg nav-tabs nav-tabs-bottom search-results-tabs">
    <li {{ Request::is('*/trees') ? 'class=active' : '' }}>
        <a href="{{ route('tree.index', $tournament->slug) }}">
            <i class="position-left"></i> {{trans_choice('core.tree',2)}}
        </a>
    </li>
    <li {{ Request::is('*/fights') ? 'class=active' : '' }}>
        <a href="{{ route('fights.index', $tournament->slug) }}">
            <i class="position-left"></i> {{trans_choice('core.fight',2)}}
        </a>
    </li>
    <li {{ Request::is('*/scoresheets') ? 'class=active' : '' }}>
        <a href="{{ route('scoresheets.index', $tournament->slug) }}">
            <i class="position-left"></i> {{trans_choice('core.scoresheet',2)}}
        </a>
    </li>
</ul>