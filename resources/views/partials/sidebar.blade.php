<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard*') || Request::is('/*') ? '' : 'collapsed' }}"
                href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ Request::is('books*') ? '' : 'collapsed' }}" href="{{ route('books.index') }}">
                <i class="bi bi-journal-text"></i>
                <span>Books</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ Request::is('borrowings*') ? '' : 'collapsed' }}"
                href="{{ route('borrowings.index') }}">
                <i class="bi bi-list"></i>
                <span>Borrowings</span>
            </a>
        </li>

    </ul>
</aside>
