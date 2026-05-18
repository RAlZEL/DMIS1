<style>
    :root {
        --ims-space-1: 0.5rem;
        --ims-space-2: 0.75rem;
        --ims-space-3: 1rem;
        --ims-space-4: 1.25rem;
        --ims-radius-sm: 0.5rem;
        --ims-radius-md: 0.75rem;
        --ims-radius-lg: 1rem;
        --ims-primary-600: #059669;
        --ims-primary-700: #047857;
        --ims-secondary-600: #2563eb;
        --ims-secondary-700: #1d4ed8;
        --ims-border: #e2e8f0;
        --ims-text: #0f172a;
        --ims-surface: #ffffff;
        --ims-surface-soft: #f8fafc;
    }

    .ims-page,
    .ims-page-row,
    .ims-page-col {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
        min-height: 0;
    }

    .ims-page {
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .ims-page-row {
        display: flex;
        flex: 1 1 auto;
        min-height: 0;
    }

    .ims-page-col {
        display: flex;
        flex-direction: column;
        flex: 1 1 auto;
        min-height: 0;
    }

    .ims-main-card {
        margin: 0;
        border: 0;
        border-radius: 0;
        overflow: hidden;
        background: var(--ims-surface);
        display: flex;
        flex-direction: column;
        flex: 1 1 auto;
        min-height: 0;
    }

    .ims-toolbar {
        padding: 0.75rem var(--ims-space-4) !important;
        border-bottom: 1px solid var(--ims-border) !important;
        background: linear-gradient(180deg, #ffffff 0%, #f8fafb 100%);
        flex: 0 0 auto;
    }

    .ims-per-page-select {
        min-width: 80px;
    }

    .ims-toolbar-actions .btn {
        border-radius: var(--ims-radius-sm);
        font-size: 0.78rem;
        font-weight: 600;
        padding: 0.5rem 0.9rem;
        border-width: 1px;
    }

    .ims-btn-primary {
        background: linear-gradient(135deg, var(--ims-primary-600) 0%, var(--ims-primary-700) 100%);
        border-color: var(--ims-primary-700);
        color: #fff;
    }

    .ims-btn-secondary {
        background: linear-gradient(135deg, var(--ims-secondary-600) 0%, var(--ims-secondary-700) 100%);
        border-color: var(--ims-secondary-700);
        color: #fff;
    }

    .ims-btn-secondary.btn-outline-info {
        background: #ffffff;
        border-color: #0891b2;
        color: #0e7490;
    }

    .ims-btn-tertiary {
        background: #ffffff;
        border-color: #94a3b8;
        color: #475569;
    }

    .ims-stats-wrap {
        padding: var(--ims-space-3) var(--ims-space-4) !important;
        background: var(--ims-surface-soft) !important;
        border-bottom: 0;
        flex: 0 0 auto;
    }

    .ims-stats-wrap .card {
        border-radius: var(--ims-radius-md);
    }

    .ims-table-wrap {
        flex: 1 1 auto;
        min-height: 0;
        overflow-x: auto;
        overflow-y: auto;
        max-height: none;
    }

    .ims-table-wrap::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    .ims-table-wrap::-webkit-scrollbar-track {
        background: #f1f5f9;
    }

    .ims-table-wrap::-webkit-scrollbar-thumb {
        background: #94a3b8;
        border-radius: 999px;
    }

    .inventory-table {
        width: max-content;
        min-width: 1720px;
        table-layout: auto;
        margin: 0;
    }

    .inventory-table thead th {
        position: sticky;
        top: 0;
        z-index: 5;
        padding: 0.7rem 0.45rem !important;
        font-size: 0.69rem;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        line-height: 1.25;
        border-bottom: 1px solid #cbd5e1 !important;
        color: #334155;
        background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%) !important;
        white-space: nowrap;
        text-align: center !important;
        vertical-align: middle;
    }

    .inventory-table tbody td {
        padding: 0.65rem 0.45rem !important;
        font-size: 0.75rem;
        line-height: 1.3;
        text-align: center !important;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9 !important;
        color: var(--ims-text);
    }

    .inventory-table tbody tr {
        height: max(3.5rem, calc((100% - 3rem) / var(--ims-visible-rows, 1)));
    }

    .inventory-table tbody tr:nth-child(even) {
        background: #fbfdff;
    }

    .inventory-table tbody tr:hover {
        background: #eff6ff !important;
    }

    .inventory-table tbody td.specification-cell {
        width: 200px;
        min-width: 200px;
        max-width: 200px;
        overflow: hidden;
        text-align: center !important;
        vertical-align: middle;
    }

    .inventory-table tbody td.specification-cell .specification-content {
        display: flex;
        width: 100%;
        align-items: center;
        justify-content: center;
        gap: 0.2rem;
        line-height: 1.25;
    }

    .inventory-table tbody td.specification-cell .specification-cell-text {
        display: inline-block;
        vertical-align: middle;
        flex: 0 1 auto;
        max-width: calc(100% - 68px);
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        text-align: center;
    }

    .inventory-table tbody td.specification-cell .specification-toggle-btn {
        border: 0;
        background: transparent;
        padding: 0;
        font-size: 0.68rem;
        font-weight: 600;
        color: #1d4ed8;
        text-decoration: underline;
        text-underline-offset: 2px;
        line-height: 1;
        cursor: pointer;
        margin-left: 0.2rem;
        vertical-align: middle;
    }

    .inventory-table tbody td.specification-cell .specification-toggle-btn:hover {
        color: #1e40af;
    }

    .inventory-table tbody td.specification-cell.is-expanded .specification-content {
        display: block;
        width: 100%;
    }

    .inventory-table tbody td.specification-cell.is-expanded .specification-cell-text {
        display: inline;
        max-width: none;
        white-space: normal;
        overflow: visible;
        text-overflow: clip;
        word-break: break-word;
    }

    .inventory-table th:nth-child(1), .inventory-table td:nth-child(1) { width: 150px; min-width: 150px; }
    .inventory-table th:nth-child(2), .inventory-table td:nth-child(2) { width: 190px; min-width: 190px; }
    .inventory-table th:nth-child(3), .inventory-table td:nth-child(3) { width: 200px; min-width: 200px; max-width: 200px; }
    .inventory-table th:nth-child(4), .inventory-table td:nth-child(4) { width: 145px; min-width: 145px; }
    .inventory-table th:nth-child(5), .inventory-table td:nth-child(5) { width: 160px; min-width: 160px; }
    .inventory-table th:nth-child(6), .inventory-table td:nth-child(6) { width: 140px; min-width: 140px; }
    .inventory-table th:nth-child(7), .inventory-table td:nth-child(7) { width: 190px; min-width: 190px; }
    .inventory-table th:nth-child(8), .inventory-table td:nth-child(8) { width: 210px; min-width: 210px; }
    .inventory-table th:nth-child(9), .inventory-table td:nth-child(9) { width: 140px; min-width: 140px; }
    .inventory-table th:nth-child(10), .inventory-table td:nth-child(10) { width: 140px; min-width: 140px; }
    .inventory-table th:nth-child(11), .inventory-table td:nth-child(11) { width: 170px; min-width: 170px; }
    .inventory-table th:nth-child(12), .inventory-table td:nth-child(12) { width: 145px; min-width: 145px; }
    .inventory-table th:nth-child(13), .inventory-table td:nth-child(13) { width: 220px; min-width: 220px; }
    .inventory-table th:nth-child(14), .inventory-table td:nth-child(14) { width: 130px; min-width: 130px; }

    .date-badge {
        padding: 0.35rem 0.5rem !important;
        border-radius: var(--ims-radius-sm) !important;
        font-size: 0.7rem !important;
        font-weight: 700 !important;
        border: 1px solid #cbd5e1 !important;
        background: #f8fafc !important;
    }

    .currency-inline {
        white-space: nowrap;
        font-weight: 600;
    }

    .action-dropdown-btn {
        border-radius: var(--ims-radius-sm);
        font-size: 0.72rem;
        font-weight: 700;
        padding: 0.35rem 0.7rem;
        white-space: nowrap;
        background: linear-gradient(135deg, var(--ims-primary-600) 0%, var(--ims-primary-700) 100%);
        border-color: var(--ims-primary-700);
    }

    .action-dropdown-menu {
        min-width: 160px;
        border-radius: var(--ims-radius-md);
        border: 1px solid var(--ims-border);
        box-shadow: 0 12px 24px rgba(15, 23, 42, 0.12);
        z-index: 1085;
    }

    .action-dropdown-menu {
        z-index: 1085;
    }

    .action-dropdown-menu .dropdown-item {
        display: flex;
        align-items: flex-end;
        gap: 0.5rem;
        font-size: 0.75rem;
        font-weight: 600;
        border-radius: 0.45rem;
        padding: 0.45rem 0.6rem;
    }

    .ims-table-footer {
        background: #f8fafc !important;
        border-top: 1px solid var(--ims-border) !important;
        flex: 0 0 auto;
        padding: 0.02rem 0.65rem 0.42rem !important;
        min-height: 0;
        overflow: visible;
    }

    .ims-table-footer .pagination .page-link {
        border-radius: 0.4rem;
        border-color: #cbd5e1;
        color: #475569;
        font-size: 0.74rem;
        min-width: 1.72rem;
        height: 1.72rem;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        line-height: 1;
        text-align: center;
        background: #ffffff;
        box-shadow: 0 1px 2px rgba(15, 23, 42, 0.04);
    }

    .ims-table-footer .pagination {
        margin: 0;
        gap: 0.12rem;
        align-items: flex-end;
        justify-content: center;
        transform: none;
    }

    .ims-table-footer .pagination .page-item {
        display: flex;
        align-items: flex-end;
    }

    .ims-table-footer .d-flex {
        min-height: 2.28rem;
        margin: 0;
        line-height: 1;
        display: flex;
        align-items: flex-end !important;
        justify-content: flex-end;
    }

    .ims-table-footer nav {
        min-height: 0;
        margin: 0;
        line-height: 1;
        display: flex;
        align-items: flex-end;
        overflow: visible;
    }

    .ims-table-footer .pagination .page-link:hover {
        background: #eef2ff;
        border-color: #a5b4fc;
        color: #3730a3;
    }

    .ims-table-footer .pagination .page-item.disabled .page-link {
        background: #f8fafc;
        color: #94a3b8;
        border-color: #e2e8f0;
        box-shadow: none;
    }

    .ims-table-footer .pagination .page-item.active .page-link {
        background: var(--ims-secondary-600);
        border-color: var(--ims-secondary-600);
        color: #fff;
        box-shadow: 0 4px 10px rgba(37, 99, 235, 0.24);
    }

    .modal-content {
        border-radius: var(--ims-radius-lg);
    }

    .ims-modal-shell .modal-content {
        border: 1px solid var(--ims-border);
        box-shadow: 0 16px 32px rgba(15, 23, 42, 0.14);
    }

    .ims-modal-shell .modal-body {
        background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);
    }

    .ims-modal-shell .ims-create-property-card {
        border-color: #dbe4ee;
        box-shadow: 0 12px 24px rgba(15, 23, 42, 0.06);
    }

    .ims-modal-shell .ims-create-property-title {
        font-size: 0.95rem;
        letter-spacing: 0.01em;
    }

    /* Keep Add Property modal style deterministic across Livewire re-renders */
    #create_property_modal .ims-create-property-card {
        border: 1px solid #dbe4ee;
        border-radius: 0.85rem;
        box-shadow: none;
    }

    #create_property_modal .ims-create-property-card .card-body {
        padding: 1rem 1.15rem;
    }

    #create_property_modal .ims-create-property-title {
        margin-bottom: 1rem;
        font-size: 1rem;
        font-weight: 700;
        color: #0f172a;
    }

    #create_property_modal .ims-create-property-form .form-label {
        font-size: 0.78rem;
        font-weight: 600;
        color: #334155;
    }

    #create_property_modal .ims-create-property-form .form-control,
    #create_property_modal .ims-create-property-form .form-select,
    #create_property_modal .ims-create-property-form .input-group-text {
        border-radius: 0.55rem;
        border-color: #cbd5e1;
        font-size: 0.82rem;
    }

    #create_property_modal .ims-create-property-form .form-control:focus,
    #create_property_modal .ims-create-property-form .form-select:focus {
        border-color: #1d4ed8;
        box-shadow: 0 0 0 0.2rem rgba(29, 78, 216, 0.12);
    }

    #create_property_modal .ims-create-property-form .input-group-text {
        background: #f8fafc;
        color: #334155;
        font-weight: 600;
    }

    #create_property_modal .ims-currency-input-group {
        align-items: stretch;
        border: 1px solid #cbd5e1;
        border-radius: 0.7rem;
        overflow: hidden;
        background: #ffffff;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    #create_property_modal .ims-currency-input-group:focus-within {
        border-color: #2563eb;
        box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.12);
    }

    #create_property_modal .ims-currency-input-group.is-invalid {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.18rem rgba(220, 53, 69, 0.12);
    }

    #create_property_modal .ims-currency-input-group .input-group-text,
    #create_property_modal .ims-currency-input-group .form-control,
    #create_property_modal .ims-currency-input-group .btn {
        border: 0;
        border-radius: 0;
        min-height: 2.5rem;
    }

    #create_property_modal .ims-currency-input-group .input-group-text {
        min-width: 3rem;
        justify-content: center;
        background: #f8fafc;
        color: #0f172a;
    }

    #create_property_modal .ims-currency-input-group .form-control {
        text-align: right;
        font-variant-numeric: tabular-nums;
        padding-right: 0.9rem;
        box-shadow: none !important;
    }

    #create_property_modal .ims-currency-input-group .form-control:focus {
        box-shadow: none !important;
    }

    #create_property_modal .ims-currency-clear {
        min-width: 2.85rem;
        background: #f8fafc;
        color: #64748b;
        font-size: 1rem;
        font-weight: 700;
    }

    #create_property_modal .ims-currency-clear:hover,
    #create_property_modal .ims-currency-clear:focus {
        background: #eff6ff;
        color: #2563eb;
        box-shadow: none;
    }

    #create_property_modal .ims-currency-meta {
        margin-top: 0.45rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.65rem;
        flex-wrap: wrap;
    }

    #create_property_modal .ims-unit-value-chip {
        display: inline-flex;
        align-items: center;
        border-radius: 999px;
        padding: 0.24rem 0.62rem;
        font-size: 0.67rem;
        font-weight: 700;
        letter-spacing: 0.01em;
        white-space: nowrap;
    }

    #create_property_modal .ims-unit-value-chip.is-ppe {
        background: rgba(22, 163, 74, 0.12);
        color: #15803d;
    }

    #create_property_modal .ims-unit-value-chip.is-semi {
        background: rgba(37, 99, 235, 0.12);
        color: #1d4ed8;
    }

    #create_property_modal .ims-unit-value-chip.is-neutral {
        background: #f1f5f9;
        color: #64748b;
    }
    #create_property_modal .ims-helper-text {
        color: #64748b;
        font-size: 0.72rem;
    }

    #create_property_modal .ims-create-actions {
        margin-top: 0.6rem;
    }

    #create_property_modal .ims-create-actions .btn {
        min-width: 140px;
        border-radius: 0.55rem;
        font-size: 0.8rem;
        font-weight: 600;
    }

    #create_property_modal .ims-create-actions .btn.ims-create-primary {
        background: linear-gradient(135deg, #059669 0%, #047857 100%) !important;
        border-color: #047857 !important;
        color: #fff !important;
    }

    #create_property_modal #createPropertySubmitBtn {
        background: linear-gradient(135deg, #059669 0%, #047857 100%) !important;
        border-color: #047857 !important;
        color: #fff !important;
    }

    #create_property_modal .ims-create-actions .btn.ims-create-primary:hover,
    #create_property_modal .ims-create-actions .btn.ims-create-primary:focus {
        background: linear-gradient(135deg, #047857 0%, #065f46 100%) !important;
        border-color: #065f46 !important;
        color: #fff !important;
    }

    #create_property_modal #createPropertySubmitBtn:hover,
    #create_property_modal #createPropertySubmitBtn:focus {
        background: linear-gradient(135deg, #047857 0%, #065f46 100%) !important;
        border-color: #065f46 !important;
        color: #fff !important;
    }

    #create_property_modal .ims-create-actions .btn.ims-create-clear {
        border-color: #94a3b8 !important;
        color: #475569 !important;
        background: #fff !important;
    }

    #create_property_modal #createPropertyClearBtn {
        border-color: #94a3b8 !important;
        color: #475569 !important;
        background: #fff !important;
    }

    #create_property_modal .ims-create-actions .btn.ims-create-clear:hover,
    #create_property_modal .ims-create-actions .btn.ims-create-clear:focus {
        border-color: #64748b !important;
        color: #334155 !important;
        background: #fff !important;
    }

    #create_property_modal #createPropertyClearBtn:hover,
    #create_property_modal #createPropertyClearBtn:focus {
        border-color: #64748b !important;
        color: #334155 !important;
        background: #fff !important;
    }

    #create_property_modal .ims-officer-dropdown {
        max-height: 220px;
        overflow-y: auto;
        z-index: 1056;
        border-radius: 0.55rem;
        border: 1px solid #dbe4ee;
        box-shadow: 0 10px 24px rgba(15, 23, 42, 0.08);
    }

    #create_property_modal .ims-officer-dropdown .dropdown-item {
        font-size: 0.8rem;
        padding: 0.45rem 0.6rem;
    }

    #create_property_modal .ims-remarks-custom .btn {
        font-size: 0.72rem;
        padding: 0.2rem 0.45rem;
    }

    #create_property_modal .ims-decimal-input::-webkit-outer-spin-button,
    #create_property_modal .ims-decimal-input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .modal-header,
    .modal-body,
    .modal-footer {
        padding: var(--ims-space-3) var(--ims-space-4);
    }

    .ims-filter-modal .modal-content {
        border: 1px solid #dbe4ee;
        box-shadow: 0 16px 30px rgba(15, 23, 42, 0.12);
    }

    .ims-filter-header {
        background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
        border-bottom: 1px solid #dbe4ee;
    }

    .ims-filter-heading {
        min-width: 0;
    }

    .ims-filter-title {
        margin: 0;
        font-size: 1rem;
        font-weight: 700;
        color: #0f172a;
    }

    .ims-filter-subtitle {
        margin: 0.2rem 0 0;
        font-size: 0.76rem;
        color: #64748b;
    }

    .ims-filter-body {
        background: #f8fafc;
        display: flex;
        flex-direction: column;
        gap: 0.85rem;
    }

    .ims-filter-section {
        border: 1px solid #dbe4ee;
        border-radius: 0.72rem;
        background: #ffffff;
        padding: 0.82rem 0.9rem;
    }

    .ims-filter-section.ims-filter-section-soft {
        background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
    }

    .ims-filter-section-head {
        margin-bottom: 0.72rem;
    }

    .ims-filter-section-title {
        margin: 0;
        font-size: 0.85rem;
        font-weight: 700;
        color: #0f172a;
    }

    .ims-filter-section-subtitle {
        margin: 0.2rem 0 0;
        font-size: 0.73rem;
        color: #64748b;
    }

    .ims-filter-label {
        font-size: 0.76rem;
        font-weight: 600;
        color: #334155;
        margin-bottom: 0.34rem;
    }

    .ims-filter-control {
        border-color: #cbd5e1;
        border-radius: 0.55rem;
        font-size: 0.8rem;
    }

    .ims-filter-control:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.12);
    }

    .ims-filter-helper {
        margin-top: 0.3rem;
        font-size: 0.7rem;
        color: #64748b;
    }

    .ims-filter-officer-dropdown {
        max-height: 220px;
        overflow-y: auto;
        z-index: 1056;
        border: 1px solid #cbd5e1;
        border-radius: 0.6rem;
        box-shadow: 0 14px 28px rgba(15, 23, 42, 0.12);
    }

    .ims-filter-officer-dropdown .dropdown-item {
        font-size: 0.78rem;
        padding: 0.45rem 0.62rem;
    }

    .ims-filter-officer-dropdown .dropdown-item:hover {
        background: #eef2ff;
        color: #1e3a8a;
    }

    .ims-filter-clear-btn {
        border-color: #cbd5e1;
        color: #64748b;
    }

    .ims-filter-footer {
        background: #ffffff;
        border-top: 1px solid #dbe4ee;
        gap: 0.45rem;
    }

    .ims-filter-clear-link {
        font-size: 0.78rem;
        font-weight: 600;
        color: #475569;
        text-decoration: none;
    }

    .ims-filter-clear-link:hover {
        color: #1e293b;
        text-decoration: underline;
    }

    .ims-article-modal {
        --ims-article-border: #dbe4ee;
        --ims-article-surface: #ffffff;
        --ims-article-surface-soft: #f8fafc;
        --ims-article-surface-soft-2: #f1f5f9;
        --ims-article-title: #0f172a;
        --ims-article-subtitle: #64748b;
    }

    .ims-article-header {
        background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
    }

    .ims-article-heading-title {
        margin: 0;
        font-size: 1.02rem;
        font-weight: 700;
        color: var(--ims-article-title);
    }

    .ims-article-heading-subtitle {
        margin: 0.2rem 0 0;
        font-size: 0.78rem;
        color: var(--ims-article-subtitle);
    }

    .ims-article-body {
        background: #f8fafc;
    }

    .ims-article-tabs {
        gap: 0.5rem;
        margin-bottom: 0.85rem;
    }

    .ims-article-tabs .nav-link {
        border: 1px solid var(--ims-article-border);
        background: #ffffff;
        color: #475569;
        border-radius: 999px;
        font-size: 0.78rem;
        font-weight: 700;
        padding: 0.48rem 0.92rem;
        line-height: 1;
        transition: all 0.18s ease;
    }

    .ims-article-tabs .nav-link:hover {
        border-color: #93c5fd;
        color: #1d4ed8;
        background: #eff6ff;
    }

    .ims-article-tabs .nav-link.active {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        border-color: #1d4ed8;
        color: #ffffff;
        box-shadow: 0 6px 14px rgba(37, 99, 235, 0.22);
    }

    .ims-article-tab-content {
        margin-top: 0.15rem;
    }

    .ims-article-tab-pane {
        display: flex;
        flex-direction: column;
        gap: 0.8rem;
    }

    .ims-article-section-card {
        border: 1px solid var(--ims-article-border);
        border-radius: var(--ims-radius-md);
        background: linear-gradient(180deg, var(--ims-article-surface) 0%, var(--ims-article-surface-soft) 100%);
        padding: 0.82rem 0.9rem;
    }

    .ims-article-section-head {
        margin-bottom: 0.75rem;
    }

    .ims-article-section-title {
        font-size: 0.88rem;
        font-weight: 700;
        color: var(--ims-article-title);
        margin: 0;
    }

    .ims-article-section-subtitle {
        margin: 0.25rem 0 0;
        font-size: 0.74rem;
        color: var(--ims-article-subtitle);
    }

    .ims-article-form {
        background: transparent;
        border: 0;
        border-radius: 0;
        padding: 0;
    }

    .ims-article-form .form-label {
        font-size: 0.76rem;
        margin-bottom: 0.35rem;
        color: #334155;
    }

    .ims-article-form .form-control,
    .ims-article-form .form-select {
        border-color: #cbd5e1;
        border-radius: 0.55rem;
        font-size: 0.8rem;
    }

    .ims-article-form .form-control:focus,
    .ims-article-form .form-select:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.12);
    }

    .ims-article-form-actions {
        margin-top: 0.2rem;
    }

    .ims-article-form-actions .btn {
        min-width: 120px;
        font-size: 0.78rem;
        font-weight: 600;
        border-radius: 0.55rem;
    }

    .ims-article-list-toolbar {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 0.75rem;
        margin-bottom: 0.7rem;
    }

    .ims-article-list-title {
        display: flex;
        align-items: flex-end;
        gap: 0.45rem;
        min-width: 0;
    }

    .ims-article-list-title .badge {
        font-size: 0.68rem;
        font-weight: 700;
        padding: 0.32rem 0.5rem;
        border: 1px solid #cbd5e1;
    }

    .ims-article-search-group {
        max-width: 320px;
        width: 100%;
    }

    .ims-article-search {
        min-width: 160px;
        border-color: #cbd5e1;
        border-radius: 0.55rem 0 0 0.55rem !important;
        font-size: 0.78rem;
    }

    .ims-article-search-group .btn {
        border-radius: 0 0.55rem 0.55rem 0 !important;
        font-size: 0.74rem;
        font-weight: 600;
    }

    .ims-article-table-wrap {
        border: 1px solid var(--ims-article-border);
        border-radius: 0.65rem;
        max-height: 272px;
        overflow: auto;
        background: #ffffff;
    }

    .ims-article-table thead th {
        position: sticky;
        top: 0;
        z-index: 1;
        background: var(--ims-article-surface-soft-2);
        border-bottom: 1px solid var(--ims-article-border);
        color: #475569;
        font-size: 0.68rem;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        padding: 0.55rem 0.6rem;
    }

    .ims-article-table tbody td {
        font-size: 0.77rem;
        color: #334155;
        vertical-align: middle;
        padding: 0.5rem 0.6rem;
    }

    .ims-article-table tbody tr:hover {
        background: #eef2ff;
    }

    .ims-inline-actions {
        white-space: nowrap;
    }

    .ims-inline-actions .btn {
        min-width: 62px;
        font-size: 0.72rem;
        padding: 0.28rem 0.52rem;
        border-radius: 0.45rem;
        margin-left: 0.2rem;
    }


    .ims-inline-confirm-copy {
        display: inline-flex;
        align-items: center;
        margin-right: 0.3rem;
        color: #9f1239;
        font-size: 0.7rem;
        font-weight: 700;
        white-space: normal;
        vertical-align: middle;
    }
    .ims-article-empty {
        display: flex;
        align-items: flex-end;
        justify-content: center;
        gap: 0.45rem;
        color: #64748b;
        font-size: 0.76rem;
        font-weight: 600;
        padding: 0.2rem 0;
    }

    .ims-article-guard {
        display: flex;
        align-items: flex-end;
        gap: 0.5rem;
        border: 1px dashed #fbbf24;
        background: #fffbeb;
        border-radius: 0.6rem;
        padding: 0.55rem 0.7rem;
        margin-bottom: 0.7rem;
        color: #92400e;
        font-size: 0.74rem;
        font-weight: 600;
    }

    .badge {
        border-radius: 999px;
    }

    .text-sm {
        font-size: 0.75rem !important;
    }

    .fw-500 {
        font-weight: 500 !important;
    }

    .fw-600 {
        font-weight: 600 !important;
    }

    @media (max-width: 992px) {
        .ims-toolbar {
            padding: var(--ims-space-2) var(--ims-space-3) !important;
        }

        .ims-toolbar-actions {
            width: 100%;
            justify-content: flex-start;
            gap: 0.5rem !important;
        }

        .ims-toolbar-actions .btn {
            flex: 1 1 auto;
            min-width: 120px;
        }

        .ims-stats-wrap {
            padding: var(--ims-space-2) var(--ims-space-3) !important;
        }

        .inventory-table tbody td {
            font-size: 0.72rem;
        }

        .action-dropdown-btn {
            min-width: 74px;
        }

        .ims-article-list-toolbar {
            flex-wrap: wrap;
        }

        .ims-article-search-group {
            max-width: 100%;
        }

        .ims-filter-footer {
            flex-wrap: wrap;
            justify-content: flex-end;
        }

        .ims-filter-clear-link {
            order: 3;
            margin-right: auto;
            margin-left: 0;
        }
    }

    @media (max-width: 768px) {
        .inventory-table th:nth-child(3),
        .inventory-table td:nth-child(3),
        .inventory-table tbody td.specification-cell {
            width: 160px;
            min-width: 160px;
            max-width: 160px;
        }

        .inventory-table tbody td.specification-cell .specification-cell-text {
            max-width: calc(100% - 68px);
        }

        .ims-toolbar-actions .btn {
            min-width: 0;
            font-size: 0.72rem;
            padding: 0.45rem 0.6rem;
        }

        .inventory-table thead th {
            font-size: 0.66rem;
            padding: 0.6rem 0.35rem !important;
        }

        .inventory-table tbody td {
            padding: 0.55rem 0.35rem !important;
            line-height: 1.25;
            font-size: 0.7rem;
        }

        .modal-header,
        .modal-body,
        .modal-footer {
            padding: var(--ims-space-2) var(--ims-space-3);
        }

        .ims-filter-title {
            font-size: 0.92rem;
        }

        .ims-filter-subtitle {
            font-size: 0.72rem;
        }

        .ims-filter-section {
            padding: 0.7rem;
        }

        .ims-filter-section-subtitle {
            font-size: 0.7rem;
        }

        .ims-filter-footer {
            justify-content: stretch;
        }

        .ims-filter-footer .btn {
            width: 100%;
        }

        .ims-filter-clear-link {
            width: auto !important;
            margin-right: 0;
            margin-left: 0;
            text-align: left;
            padding-left: 0;
        }

        .ims-article-heading-title {
            font-size: 0.94rem;
        }

        .ims-article-heading-subtitle {
            font-size: 0.72rem;
        }

        .ims-article-tabs {
            gap: 0.35rem;
        }

        .ims-article-tabs .nav-item {
            flex: 1 1 calc(33.333% - 0.24rem);
        }

        .ims-article-tabs .nav-link {
            width: 100%;
            text-align: center;
            padding: 0.45rem 0.55rem;
        }

        .ims-article-section-card {
            padding: 0.72rem;
        }

        .ims-article-list-toolbar {
            flex-direction: column;
            align-items: stretch;
            gap: 0.5rem;
        }

        .ims-article-search-group {
            max-width: 100%;
        }

        .ims-article-search {
            min-width: 0;
            width: 100%;
        }

        .ims-article-table-wrap {
            max-height: 238px;
        }

        .ims-inline-actions .btn {
            margin-left: 0.12rem;
            min-width: 56px;
            font-size: 0.7rem;
        }

        .ims-article-form-actions {
            flex-wrap: wrap;
        }

        .ims-article-form-actions .btn {
            width: 100%;
            min-width: 0;
        }

        #create_property_modal .ims-create-property-card .card-body {
            padding: 0.85rem;
        }

        #create_property_modal .ims-create-actions {
            flex-wrap: wrap;
        }

        #create_property_modal .ims-create-actions .btn {
            width: 100%;
        }
    }

    /* Compact admin workspace override */
    .ims-main-card {
        background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);
    }

    .ims-toolbar {
        padding: 0.52rem 0.85rem !important;
        background: #ffffff;
        border-bottom: 1px solid #dbe4ee !important;
    }

    .ims-toolbar > .d-flex {
        justify-content: space-between;
        width: 100%;
    }

    .ims-per-page-select {
        min-width: 76px;
        border-radius: 0.6rem;
        border-color: #cbd5e1;
        background-color: #ffffff;
    }

    .ims-toolbar-actions .btn {
        min-height: 2rem;
        padding: 0.42rem 0.8rem;
        font-size: 0.75rem;
        box-shadow: none;
    }

    .ims-stats-wrap {
        padding: 0.45rem 0.85rem !important;
        background: #f8fafc !important;
    }

    .ims-stats-wrap .row {
        --bs-gutter-x: 0.55rem;
        --bs-gutter-y: 0.55rem;
    }

    .ims-stats-wrap .card {
        border: 1px solid #dbe4ee !important;
        border-radius: 0.9rem;
        box-shadow: none !important;
        background: #ffffff;
    }

    .ims-stats-wrap .card-body {
        padding: 0.62rem 0.78rem;
    }

    .ims-stats-wrap .h3 {
        font-size: 1.08rem;
        letter-spacing: -0.01em;
    }

    .ims-filter-summary-strip {
        margin: 0 0.85rem 0.45rem;
        padding: 0.48rem 0.65rem;
        border: 1px solid #dbe4ee;
        border-radius: 0.8rem;
        background: rgba(255, 255, 255, 0.96);
        display: flex;
        flex-direction: column;
        gap: 0.4rem;
    }

    .ims-filter-summary-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 0.75rem;
    }

    .ims-filter-summary-title {
        margin: 0;
        font-size: 0.82rem;
        font-weight: 700;
        color: #0f172a;
    }

    .ims-filter-summary-subtitle {
        margin-top: 0.1rem;
        font-size: 0.69rem;
        color: #64748b;
    }

    .ims-filter-chip-row {
        display: flex;
        flex-wrap: wrap;
        gap: 0.45rem;
    }

    .ims-filter-chip {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.28rem 0.48rem;
        border-radius: 999px;
        border: 1px solid #dbe4ee;
        background: #ffffff;
        font-size: 0.69rem;
        color: #334155;
    }

    .ims-filter-chip-label {
        font-weight: 700;
        color: #1d4ed8;
    }

    .ims-filter-chip-muted {
        color: #64748b;
    }

    .ims-summary-clear-btn {
        border-radius: 999px;
        border: 1px solid #cbd5e1;
        background: #ffffff;
        color: #475569;
        font-size: 0.72rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.38rem 0.72rem;
    }

    .ims-records-shell {
        flex: 1 1 auto;
        min-height: 0;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        padding: 0 0.85rem 0;
    }

    .ims-table-panel {
        flex: 1 1 auto;
        min-height: 0;
        background: #ffffff;
        border: 1px solid #dbe4ee;
        border-radius: 1rem;
        overflow: hidden;
    }

    .ims-table-wrap {
        flex: 1 1 auto;
        min-height: 0;
        overflow-x: auto;
        overflow-y: auto;
        padding: 0.45rem 0 0;
        background: #ffffff;
    }

    .inventory-table {
        width: max-content;
        min-width: 1630px;
        height: 100%;
        border-collapse: separate;
        border-spacing: 0;
        background: #ffffff;
        border: 0;
        border-radius: 0;
        overflow: hidden;
    }

    .inventory-table thead th {
        top: 0;
        z-index: 3;
        padding: 0.72rem 0.5rem !important;
        font-size: 0.68rem;
        background: linear-gradient(180deg, #f8fafc 0%, #eef3f9 100%) !important;
        border-bottom: 1px solid #dbe4ee !important;
        color: #334155;
        text-align: center !important;
        vertical-align: middle;
    }

    .inventory-table tbody td {
        padding: 0.72rem 0.55rem !important;
        font-size: 0.74rem;
        text-align: center !important;
        vertical-align: middle;
border-bottom: 1px solid #eef2f7 !important;
        background: #ffffff;
    }

    .inventory-table tbody tr:nth-child(even) td {
        background: #fbfcfe;
    }

    .inventory-table tbody tr:hover td {
        background: #eef6ff !important;
    }

    .inventory-table tbody td.specification-cell,
    .inventory-table th:nth-child(3),
    .inventory-table td:nth-child(3) {
        width: 210px;
        min-width: 210px;
        max-width: 210px;
        text-align: center;
        vertical-align: middle;
    }

    .inventory-table tbody td.specification-cell .specification-content {
        display: flex;
        width: 100%;
        align-items: center;
        justify-content: center;
        gap: 0.24rem;
        line-height: 1.35;
    }

    .inventory-table tbody td.specification-cell .specification-cell-text {
        flex: 0 1 auto;
        max-width: calc(100% - 72px);
        text-align: center;
    }

    .inventory-table tbody td.specification-cell .specification-toggle-btn {
        margin-left: 0.24rem;
        font-size: 0.67rem;
        vertical-align: baseline;
    }

    .inventory-table th:nth-child(1), .inventory-table td:nth-child(1) { width: 155px; min-width: 155px; }
    .inventory-table th:nth-child(2), .inventory-table td:nth-child(2) { width: 185px; min-width: 185px; }
    .inventory-table th:nth-child(4), .inventory-table td:nth-child(4) { width: 148px; min-width: 148px; }
    .inventory-table th:nth-child(5), .inventory-table td:nth-child(5) { width: 145px; min-width: 145px; }
    .inventory-table th:nth-child(6), .inventory-table td:nth-child(6) { width: 138px; min-width: 138px; }
    .inventory-table th:nth-child(7), .inventory-table td:nth-child(7) { width: 168px; min-width: 168px; }
    .inventory-table th:nth-child(8), .inventory-table td:nth-child(8) { width: 188px; min-width: 188px; }
    .inventory-table th:nth-child(9), .inventory-table td:nth-child(9) { width: 128px; min-width: 128px; }
    .inventory-table th:nth-child(10), .inventory-table td:nth-child(10) { width: 136px; min-width: 136px; }
    .inventory-table th:nth-child(11), .inventory-table td:nth-child(11) { width: 156px; min-width: 156px; }
    .inventory-table th:nth-child(12), .inventory-table td:nth-child(12) { width: 136px; min-width: 136px; }
    .inventory-table th:nth-child(13), .inventory-table td:nth-child(13) { width: 190px; min-width: 190px; }
    .inventory-table th:nth-child(14), .inventory-table td:nth-child(14) { width: 126px; min-width: 126px; }

    .ims-action-col,
    .ims-action-cell {
        position: static;
        right: auto;
        z-index: auto;
        background: inherit;
        box-shadow: none;
    }

    .inventory-table thead .ims-action-col {
        background: linear-gradient(180deg, #f8fafc 0%, #eef3f9 100%) !important;
    }

    .action-dropdown-btn {
        min-width: 94px;
        height: 2rem;
        font-size: 0.71rem;
        font-weight: 700;
    }

    .action-dropdown-menu {
        z-index: 1085;
    }

    .action-dropdown-menu .dropdown-item {
        align-items: center;
    }

    .ims-table-footer {
        margin: 0;
        padding: 0.45rem 0.85rem 0.35rem !important;
        background: transparent !important;
        border: 0 !important;
        border-top: 0 !important;
        border-radius: 0;
    }

    .ims-table-footer .d-flex,
    .ims-table-footer nav,
    .ims-table-footer .pagination,
    .ims-table-footer .pagination .page-item {
        align-items: center !important;
    }

    .ims-table-footer .d-flex {
        min-height: 0;
        justify-content: flex-end;
    }

    .ims-table-footer .pagination {
        gap: 0.18rem;
        margin: 0;
    }

    .ims-table-footer .pagination .page-link {
        min-width: 1.9rem;
        height: 1.9rem;
        border-radius: 0.5rem;
    }

    .ims-mobile-list {
        display: flex;
        flex-direction: column;
        gap: 0.85rem;
        padding: 0.45rem 0.9rem 0.85rem;
        overflow-y: auto;
    }

    .ims-mobile-card {
        border: 1px solid #dbe4ee;
        border-radius: 1rem;
        background: #ffffff;
        padding: 0.9rem;
        box-shadow: 0 12px 24px rgba(15, 23, 42, 0.06);
        display: flex;
        flex-direction: column;
        gap: 0.8rem;
    }

    .ims-mobile-card-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 0.75rem;
    }

    .ims-mobile-card-kicker,
    .ims-mobile-meta-label {
        display: block;
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 0.04em;
        text-transform: uppercase;
        color: #64748b;
        margin-bottom: 0.2rem;
    }

    .ims-mobile-card-title {
        margin: 0;
        font-size: 0.95rem;
        font-weight: 700;
        color: #0f172a;
    }

    .ims-mobile-card-subtitle {
        margin: 0.2rem 0 0;
        font-size: 0.78rem;
        color: #475569;
    }

    .ims-mobile-card-value {
        min-width: 110px;
        text-align: right;
    }

    .ims-mobile-card-grid,
    .ims-mobile-card-extra {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 0.75rem;
    }

    .ims-mobile-meta-value {
        display: block;
        font-size: 0.78rem;
        color: #0f172a;
        line-height: 1.45;
        word-break: break-word;
    }

    .ims-mobile-card-details {
        border-top: 1px solid #eef2f7;
        padding-top: 0.75rem;
    }

    .ims-mobile-card-details summary {
        list-style: none;
        cursor: pointer;
        font-size: 0.75rem;
        font-weight: 700;
        color: #1d4ed8;
    }

    .ims-mobile-card-details summary::-webkit-details-marker {
        display: none;
    }

    .ims-mobile-card-details[open] summary {
        margin-bottom: 0.7rem;
    }

    .ims-mobile-card-actions {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 0.5rem;
    }

    .ims-mobile-card-actions .btn {
        border-radius: 0.65rem;
        font-size: 0.74rem;
        font-weight: 700;
        min-height: 2.2rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.35rem;
    }

    .ims-mobile-empty {
        border: 1px dashed #cbd5e1;
        border-radius: 1rem;
        padding: 1rem;
        background: #ffffff;
        color: #64748b;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.45rem;
        font-weight: 600;
    }

    .ims-modal-shell .modal-content {
        border: 1px solid #dbe4ee;
        box-shadow: 0 18px 38px rgba(15, 23, 42, 0.14);
        border-radius: 1rem;
        overflow: hidden;
    }

    .ims-modal-header {
        background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
        border-bottom: 1px solid #dbe4ee;
    }

    .ims-modal-header-group {
        min-width: 0;
    }

    .ims-modal-title {
        margin: 0;
        font-size: 1rem;
        font-weight: 700;
        color: #0f172a;
    }

    .ims-modal-subtitle {
        margin: 0.2rem 0 0;
        font-size: 0.75rem;
        color: #64748b;
    }

    .ims-modal-body-soft {
        background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);
    }

    .ims-modal-footer {
        background: #ffffff;
        border-top: 1px solid #dbe4ee;
        display: flex;
        justify-content: flex-end;
        gap: 0.5rem;
    }

    .ims-form-shell {
        display: flex;
        flex-direction: column;
        gap: 0.9rem;
    }

    .ims-create-property-card,
    .ims-edit-form-shell {
        display: flex;
        flex-direction: column;
        gap: 0.9rem;
    }

    .ims-form-panel {
        border: 1px solid #dbe4ee;
        border-radius: 0.95rem;
        background: #ffffff;
        padding: 0.95rem 1rem;
        box-shadow: 0 8px 20px rgba(15, 23, 42, 0.04);
    }

    .ims-form-panel-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 0.75rem;
        margin-bottom: 0.8rem;
    }

    .ims-form-panel-title,
    .ims-create-property-title {
        margin: 0;
        font-size: 0.95rem;
        font-weight: 700;
        color: #0f172a;
    }

    .ims-form-panel-subtitle {
        margin: 0.22rem 0 0;
        font-size: 0.74rem;
        color: #64748b;
    }

    .ims-create-property-form .form-label,
    .ims-edit-form-shell .form-label,
    .ims-filter-label,
    .ims-article-form .form-label {
        font-size: 0.76rem;
        font-weight: 600;
        color: #334155;
        margin-bottom: 0.34rem;
    }

    .ims-create-property-form .form-control,
    .ims-create-property-form .form-select,
    .ims-create-property-form .input-group-text,
    .ims-edit-form-shell .form-control,
    .ims-edit-form-shell .form-select,
    .ims-edit-form-shell .input-group-text {
        border-radius: 0.65rem;
        border-color: #cbd5e1;
        min-height: 2.5rem;
        font-size: 0.82rem;
    }

    .ims-create-property-form .form-control:focus,
    .ims-create-property-form .form-select:focus,
    .ims-edit-form-shell .form-control:focus,
    .ims-edit-form-shell .form-select:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.12);
    }

    .ims-helper-text,
    .ims-edit-form-shell .form-text {
        font-size: 0.71rem;
        color: #64748b;
    }
    .ims-classification-grid {
        align-items: start;
    }
    .ims-classification-grid > [class*="col-"] {
        display: flex;
        flex-direction: column;
    }
    .ims-classification-grid .form-label {
        min-height: 1.45rem;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        line-height: 1.2;
    }
    .ims-field-chip {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        align-self: center;
        min-height: 1.1rem;
        border-radius: 999px;
        padding: 0.08rem 0.42rem;
        font-size: 0.62rem;
        font-weight: 700;
        letter-spacing: 0.02em;
        line-height: 1;
        background: rgba(37, 99, 235, 0.1);
        color: #1d4ed8;
    }
    .ims-readonly-field {
        background: #f8fafc;
        color: #475569;
        font-weight: 600;
    }
    .ims-readonly-field::placeholder {
        color: #94a3b8;
        font-weight: 500;
    }
    .ims-inline-helper-card {
        display: flex;
        align-items: center;
        min-height: 2.4rem;
        padding: 0.55rem 0.8rem;
        border: 1px dashed #cbd5e1;
        border-radius: 0.75rem;
        background: #f8fbff;
        color: #64748b;
        font-size: 0.74rem;
        line-height: 1.45;
    }

    .ims-create-actions {
        margin-top: 0.15rem;
    }

    .ims-create-actions .btn,
    .ims-modal-footer .btn,
    .ims-article-form-actions .btn {
        min-width: 132px;
        border-radius: 0.7rem;
        font-weight: 700;
    }

    .ims-confirm-modal .modal-body {
        padding-top: 1.6rem;
        padding-bottom: 1.4rem;
    }

    .ims-confirm-title {
        margin-bottom: 0.35rem;
        font-size: 1rem;
        font-weight: 700;
        color: #0f172a;
    }

    .ims-confirm-copy {
        font-size: 0.76rem;
    }

    @media (max-width: 991.98px) {
        .ims-toolbar {
            padding: 0.7rem 0.85rem !important;
        }

        .ims-stats-wrap,
        .ims-filter-summary-strip,
        .ims-table-wrap {
            margin-left: 0;
            margin-right: 0;
            padding-left: 0.85rem;
            padding-right: 0.85rem;
        }

        .ims-toolbar-actions {
            width: 100%;
            justify-content: flex-start;
        }

        .ims-toolbar-actions .btn {
            flex: 1 1 calc(50% - 0.35rem);
        }
    }

    @media (max-width: 767.98px) {
        .ims-toolbar {
            padding: 0.65rem 0.8rem !important;
        }

        .ims-toolbar > .d-flex {
            gap: 0.7rem !important;
        }

        .ims-stats-wrap {
            padding: 0.7rem 0.8rem !important;
        }

        .ims-stats-wrap .card-body {
            padding: 0.75rem 0.8rem;
        }

        .ims-stats-wrap .h3 {
            font-size: 1.15rem;
        }

        .ims-filter-summary-strip {
        margin: 0 0.85rem 0.45rem;
        padding: 0.48rem 0.65rem;
        border: 1px solid #dbe4ee;
        border-radius: 0.8rem;
        background: rgba(255, 255, 255, 0.96);
        display: flex;
        flex-direction: column;
        gap: 0.4rem;
    }

        .ims-filter-summary-head {
            flex-direction: column;
        }

        .ims-table-footer {
            padding: 0.5rem 0.8rem 0.8rem !important;
        }

        .ims-table-footer .d-flex {
            justify-content: center;
        }

        .ims-mobile-card-grid,
        .ims-mobile-card-extra,
        .ims-mobile-card-actions {
            grid-template-columns: 1fr;
        }

        .ims-mobile-card-value {
            min-width: 0;
            text-align: left;
        }

        .ims-mobile-card-top {
            flex-direction: column;
        }

        .ims-form-panel {
            padding: 0.8rem;
        }

        .ims-modal-footer,
        .ims-article-form-actions,
        .ims-create-actions {
            flex-wrap: wrap;
        }

        .ims-modal-footer .btn,
        .ims-article-form-actions .btn,
        .ims-create-actions .btn {
            width: 100%;
            min-width: 0;
        }
    }
/* IMS FINAL UI REFRESH START */
    .ims-main-card {
        background: linear-gradient(180deg, #f8fbff 0%, #f3f7fc 100%);
    }

    .ims-toolbar {
        padding: 0.62rem 1rem !important;
        background: rgba(255, 255, 255, 0.96);
        border-bottom: 1px solid #e2e8f0 !important;
        backdrop-filter: blur(10px);
    }

    .ims-toolbar > .d-flex {
        gap: 0.75rem !important;
    }

    .ims-toolbar-meta {
        font-size: 0.78rem;
        font-weight: 600;
        color: #475569 !important;
    }

    .ims-per-page-select {
        min-width: 84px;
        min-height: 2.15rem;
        border-radius: 0.72rem;
        border-color: #d4deea;
        font-size: 0.78rem;
        font-weight: 600;
        color: #334155;
        box-shadow: none;
    }

    .ims-toolbar-actions {
        gap: 0.5rem !important;
    }

    .ims-toolbar-actions .btn {
        min-height: 2.15rem;
        padding: 0.48rem 0.92rem;
        border-radius: 0.78rem;
        font-size: 0.76rem;
        font-weight: 700;
        letter-spacing: 0.01em;
        box-shadow: none !important;
    }

    .ims-btn-primary {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        border-color: #047857;
        color: #ffffff;
    }

    .ims-btn-secondary:not(.btn-outline-info) {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        border-color: #1d4ed8;
        color: #ffffff;
    }

    .ims-btn-secondary.btn-outline-info {
        background: #f5fbff;
        border-color: #7dd3fc;
        color: #0f766e;
    }

    .ims-btn-tertiary {
        background: #ffffff;
        border-color: #d4deea;
        color: #475569;
    }

    .ims-toolbar-actions .btn:hover,
    .ims-summary-clear-btn:hover,
    .ims-mobile-card-actions .btn:hover {
        transform: translateY(-1px);
        transition: transform 0.16s ease, box-shadow 0.16s ease, background-color 0.16s ease;
    }

    .ims-stats-wrap {
        padding: 0.55rem 1rem 0.65rem !important;
        background: transparent !important;
    }

    .ims-stats-wrap .row {
        --bs-gutter-x: 0.7rem;
        --bs-gutter-y: 0.7rem;
    }

    .ims-stat-card {
        border: 1px solid #dbe4ee !important;
        border-radius: 1rem !important;
        box-shadow: 0 10px 24px rgba(15, 23, 42, 0.04) !important;
        background: rgba(255, 255, 255, 0.96) !important;
    }

    .ims-stat-card-body {
        padding: 0.8rem 0.9rem !important;
    }

    .ims-stat-label {
        display: flex;
        align-items: center;
        gap: 0.28rem;
        font-size: 0.73rem !important;
        font-weight: 700;
        color: #64748b !important;
        margin-bottom: 0.28rem !important;
    }

    .ims-stat-value {
        font-size: 1.28rem !important;
        letter-spacing: -0.02em;
    }

    .ims-stat-icon {
        width: 2.6rem;
        height: 2.6rem;
        border-radius: 0.88rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(180deg, #f8fafc 0%, #eff6ff 100%);
        opacity: 1 !important;
    }

    .ims-stat-icon .fa-2x {
        font-size: 1.32rem;
    }

    .ims-filter-summary-strip {
        margin: 0 1rem 0.65rem;
        padding: 0.72rem 0.85rem;
        border: 1px solid #dbe4ee;
        border-radius: 0.95rem;
        background: rgba(255, 255, 255, 0.97);
        box-shadow: 0 8px 20px rgba(15, 23, 42, 0.03);
        gap: 0.55rem;
    }

    .ims-filter-summary-head {
        align-items: center;
    }

    .ims-filter-summary-title {
        font-size: 0.8rem;
        letter-spacing: 0.01em;
    }

    .ims-filter-summary-subtitle {
        margin-top: 0.16rem;
        font-size: 0.7rem;
    }

    .ims-filter-chip-row {
        gap: 0.38rem;
    }

    .ims-filter-chip {
        padding: 0.32rem 0.56rem;
        border-radius: 999px;
        background: #f8fbff;
        border-color: #dbe4ee;
        font-size: 0.68rem;
    }

    .ims-filter-chip-value {
        color: #334155;
        font-weight: 600;
    }

    .ims-summary-clear-btn {
        padding: 0.4rem 0.78rem;
        font-size: 0.71rem;
        box-shadow: none;
    }

    .ims-records-shell {
        padding: 0 1rem 0.55rem;
        gap: 0.5rem;
    }

    .ims-table-panel {
        border: 1px solid #dbe4ee;
        border-radius: 1rem;
        background: rgba(255, 255, 255, 0.97);
        box-shadow: 0 14px 30px rgba(15, 23, 42, 0.05);
    }

    .ims-table-wrap {
        padding-top: 0;
        background: transparent;
    }

    .inventory-table {
        min-width: 1580px;
        background: #ffffff;
    }

    .inventory-table thead th {
        padding: 0.84rem 0.58rem !important;
        font-size: 0.67rem;
        letter-spacing: 0.055em;
        background: linear-gradient(180deg, #fbfdff 0%, #f1f5f9 100%) !important;
        border-bottom: 1px solid #dde6f1 !important;
        color: #334155;
    }

    .inventory-table tbody td {
        padding: 0.78rem 0.58rem !important;
        font-size: 0.75rem;
        border-bottom: 1px solid #eef2f7 !important;
    }

    .inventory-table tbody tr:nth-child(even) td {
        background: #fbfdff;
    }

    .inventory-table tbody tr:hover td {
        background: #f3f8ff !important;
    }

    .inventory-table tbody td.specification-cell .specification-content {
        gap: 0.16rem;
        justify-content: center;
        flex-wrap: nowrap;
    }

    .inventory-table tbody td.specification-cell .specification-cell-text {
        max-width: calc(100% - 52px);
    }

    .inventory-table tbody td.specification-cell .specification-toggle-btn {
        display: inline-flex;
        align-items: center;
        margin-left: 0;
        padding-top: 0.02rem;
        text-decoration-thickness: 1px;
    }

    .date-badge {
        border-radius: 999px;
        padding: 0.22rem 0.56rem;
        background: #f8fbff;
        border: 1px solid #d9e5f1;
        font-weight: 700;
        letter-spacing: 0.01em;
    }

    .action-dropdown-btn {
        min-width: 92px;
        height: 2.05rem;
        border-radius: 0.72rem;
        font-size: 0.72rem;
        font-weight: 700;
        box-shadow: none;
    }

    .action-dropdown-menu {
        border: 1px solid #dbe4ee;
        border-radius: 0.9rem;
        box-shadow: 0 16px 34px rgba(15, 23, 42, 0.12);
        padding: 0.4rem;
    }

    .action-dropdown-menu .dropdown-item {
        border-radius: 0.65rem;
        font-size: 0.74rem;
        font-weight: 600;
        padding: 0.52rem 0.65rem;
        gap: 0.45rem;
    }

    .ims-table-footer {
        padding: 0.5rem 1rem 0.15rem !important;
    }

    .ims-table-footer-inner {
        min-height: 2.2rem;
        justify-content: flex-end !important;
    }

    .ims-table-footer .pagination {
        gap: 0.28rem;
    }

    .ims-table-footer .pagination .page-link {
        min-width: 2rem;
        height: 2rem;
        border-radius: 0.72rem;
        border: 1px solid #dbe4ee;
        background: #ffffff;
        color: #475569;
        font-size: 0.78rem;
        font-weight: 700;
        box-shadow: none;
    }

    .ims-table-footer .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        border-color: #1d4ed8;
        color: #ffffff;
    }

    .ims-table-footer .pagination .page-item.disabled .page-link {
        background: #f8fafc;
        color: #94a3b8;
        border-color: #e2e8f0;
    }

    .ims-mobile-list {
        gap: 0.8rem;
        padding: 0 1rem 0.8rem;
    }

    .ims-mobile-card {
        border-radius: 1rem;
        padding: 0.95rem;
        border: 1px solid #dbe4ee;
        background: rgba(255, 255, 255, 0.97);
        box-shadow: 0 14px 30px rgba(15, 23, 42, 0.06);
        gap: 0.82rem;
    }

    .ims-mobile-card-kicker,
    .ims-mobile-meta-label {
        font-size: 0.66rem;
        letter-spacing: 0.06em;
        color: #64748b;
    }

    .ims-mobile-card-title {
        font-size: 0.96rem;
        line-height: 1.25;
    }

    .ims-mobile-card-subtitle,
    .ims-mobile-meta-value {
        font-size: 0.78rem;
    }

    .ims-mobile-card-value strong {
        font-size: 0.9rem;
    }

    .ims-mobile-card-details {
        border-top: 1px solid #edf2f7;
    }

    .ims-mobile-card-details summary {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.12rem 0;
    }

    .ims-mobile-card-actions .btn {
        min-height: 2.3rem;
        border-radius: 0.78rem;
        font-size: 0.74rem;
        box-shadow: none;
    }

    .ims-mobile-empty {
        min-height: 8rem;
        background: rgba(255, 255, 255, 0.96);
        box-shadow: 0 10px 24px rgba(15, 23, 42, 0.04);
    }

    .ims-modal-content,
    .ims-filter-modal .modal-content {
        border: 1px solid #dbe4ee;
        border-radius: 1.05rem;
        box-shadow: 0 26px 52px rgba(15, 23, 42, 0.16);
        overflow: hidden;
        background: #ffffff;
    }

    .ims-modal-header,
    .ims-filter-header,
    .ims-article-header {
        padding: 1rem 1.1rem 0.92rem;
        background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
        border-bottom: 1px solid #e9eff6 !important;
    }

    .ims-modal-title,
    .ims-filter-title,
    .ims-article-heading-title {
        font-size: 1.02rem;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
    }

    .ims-modal-subtitle,
    .ims-filter-subtitle,
    .ims-article-heading-subtitle {
        margin: 0.24rem 0 0;
        font-size: 0.76rem;
        line-height: 1.45;
        color: #64748b;
    }

    .ims-modal-body-soft,
    .ims-filter-body,
    .ims-article-body {
        padding: 1rem 1.1rem;
        background: #fbfdff;
    }

    .ims-modal-footer,
    .ims-filter-footer {
        padding: 0.92rem 1.1rem 1rem;
        background: #ffffff;
        border-top: 1px solid #e9eff6;
        gap: 0.6rem;
    }

    .ims-form-shell {
        display: flex;
        flex-direction: column;
        gap: 0.9rem;
    }

    .ims-form-panel,
    .ims-filter-section,
    .ims-article-section-card {
        border: 1px solid #e2e8f0;
        border-radius: 0.95rem;
        background: #ffffff;
        box-shadow: 0 8px 20px rgba(15, 23, 42, 0.03);
    }

    .ims-form-panel {
        padding: 0.98rem 1rem;
    }

    .ims-filter-section,
    .ims-article-section-card {
        padding: 0.95rem 1rem;
    }

    .ims-form-panel-head,
    .ims-filter-section-head,
    .ims-article-section-head {
        margin-bottom: 0.78rem;
    }

    .ims-form-panel-title,
    .ims-filter-section-title,
    .ims-article-section-title {
        font-size: 0.9rem;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
    }

    .ims-form-panel-subtitle,
    .ims-filter-section-subtitle,
    .ims-article-section-subtitle {
        margin: 0.2rem 0 0;
        font-size: 0.74rem;
        line-height: 1.45;
        color: #64748b;
    }

    .ims-create-property-form .form-label,
    .ims-edit-form-shell .form-label,
    .ims-filter-label,
    .ims-article-form .form-label {
        margin-bottom: 0.4rem;
        font-size: 0.76rem;
        font-weight: 700;
        color: #334155;
    }

    .ims-create-property-form .form-control,
    .ims-create-property-form .form-select,
    .ims-edit-form-shell .form-control,
    .ims-edit-form-shell .form-select,
    .ims-filter-control,
    .ims-article-form .form-control,
    .ims-article-form .form-select {
        min-height: 2.6rem;
        border-radius: 0.74rem;
        border-color: #d0dbe7;
        font-size: 0.82rem;
        box-shadow: none;
    }

    .ims-create-property-form .form-control:focus,
    .ims-create-property-form .form-select:focus,
    .ims-edit-form-shell .form-control:focus,
    .ims-edit-form-shell .form-select:focus,
    .ims-filter-control:focus,
    .ims-article-form .form-control:focus,
    .ims-article-form .form-select:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 0.18rem rgba(37, 99, 235, 0.12);
    }

    .ims-create-property-form .ims-currency-input-group,
    .ims-edit-form-shell .ims-currency-input-group {
        align-items: stretch;
        border: 1px solid #d0dbe7;
        border-radius: 0.74rem;
        overflow: hidden;
        background: #ffffff;
        transition: border-color 0.18s ease, box-shadow 0.18s ease;
    }

    .ims-create-property-form .ims-currency-input-group:focus-within,
    .ims-edit-form-shell .ims-currency-input-group:focus-within {
        border-color: #2563eb;
        box-shadow: 0 0 0 0.18rem rgba(37, 99, 235, 0.12);
    }

    .ims-create-property-form .ims-currency-input-group .input-group-text,
    .ims-create-property-form .ims-currency-input-group .form-control,
    .ims-create-property-form .ims-currency-input-group .btn,
    .ims-edit-form-shell .ims-currency-input-group .input-group-text,
    .ims-edit-form-shell .ims-currency-input-group .form-control,
    .ims-edit-form-shell .ims-currency-input-group .btn {
        border: 0;
        border-radius: 0;
        min-height: 2.6rem;
    }

    .ims-create-property-form .ims-currency-input-group .input-group-text,
    .ims-edit-form-shell .ims-currency-input-group .input-group-text {
        min-width: 3rem;
        justify-content: center;
        background: #f8fafc;
        color: #0f172a;
        font-weight: 700;
    }

    .ims-create-property-form .ims-currency-input-group .form-control,
    .ims-edit-form-shell .ims-currency-input-group .form-control {
        text-align: right;
        font-variant-numeric: tabular-nums;
        padding-right: 0.9rem;
        box-shadow: none !important;
    }

    .ims-create-property-form .ims-currency-clear,
    .ims-edit-form-shell .ims-currency-clear {
        min-width: 2.9rem;
        background: #f8fafc;
        color: #64748b;
        font-size: 1rem;
        font-weight: 700;
        box-shadow: none;
    }

    .ims-create-property-form .ims-currency-clear:hover,
    .ims-create-property-form .ims-currency-clear:focus,
    .ims-edit-form-shell .ims-currency-clear:hover,
    .ims-edit-form-shell .ims-currency-clear:focus {
        background: #eff6ff;
        color: #2563eb;
    }

    .ims-currency-meta {
        margin-top: 0.48rem;
    }

    .ims-classification-grid > [class*="col-"] {
        display: flex;
        flex-direction: column;
    }

    .ims-classification-grid .form-label {
        min-height: 1.45rem;
        display: inline-flex;
        align-items: center;
        gap: 0.42rem;
        line-height: 1.2;
    }

    .ims-field-chip {
        min-height: 1.1rem;
        padding: 0.08rem 0.42rem;
        font-size: 0.62rem;
        line-height: 1;
    }

    .ims-readonly-field {
        background: #f8fafc;
        color: #475569;
        font-weight: 600;
    }

    .ims-readonly-field::placeholder {
        color: #94a3b8;
        font-weight: 500;
    }

    .ims-inline-helper-card {
        min-height: 2.55rem;
        padding: 0.62rem 0.82rem;
        border-radius: 0.82rem;
        background: #f8fbff;
        border: 1px dashed #d4deea;
        font-size: 0.74rem;
        color: #64748b;
    }

    .ims-article-tabs {
        gap: 0.45rem;
        margin-bottom: 0.9rem;
    }

    .ims-article-tabs .nav-link {
        border-radius: 999px;
        padding: 0.52rem 0.86rem;
        font-size: 0.77rem;
        font-weight: 700;
        color: #475569;
        background: #f8fafc;
        border: 1px solid #dbe4ee;
    }

    .ims-article-tabs .nav-link.active {
        color: #ffffff;
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        border-color: #1d4ed8;
    }

    .ims-article-list-toolbar,
    .ims-filter-section-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .ims-article-search-group {
        max-width: 270px;
        width: 100%;
    }

    .ims-article-table-wrap {
        border: 1px solid #ecf1f6;
        border-radius: 0.85rem;
        overflow: hidden;
    }

    .ims-article-table th {
        padding: 0.68rem 0.72rem;
        font-size: 0.69rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #64748b;
        background: #f8fafc;
        border-bottom: 1px solid #e9eff6;
    }

    .ims-article-table td {
        padding: 0.72rem;
        font-size: 0.78rem;
        vertical-align: middle;
    }

    .ims-inline-actions {
        white-space: nowrap;
    }

    .ims-inline-actions .btn {
        min-width: 76px;
        border-radius: 0.65rem;
        font-size: 0.72rem;
        font-weight: 700;
        box-shadow: none;
    }

    .ims-article-empty {
        min-height: 5.25rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.45rem;
        border-radius: 0.75rem;
        background: #fbfdff;
        color: #64748b;
        font-weight: 600;
    }

    .ims-filter-modal .modal-content .input-group {
        align-items: stretch;
    }

    .ims-filter-clear-btn {
        border-color: #d0dbe7;
        background: #ffffff;
        color: #64748b;
        box-shadow: none;
    }

    .ims-filter-helper {
        margin-top: 0.35rem;
        font-size: 0.72rem;
        color: #64748b;
    }

    .ims-filter-officer-dropdown {
        margin-top: 0.35rem;
        border: 1px solid #dbe4ee;
        border-radius: 0.82rem;
        box-shadow: 0 16px 34px rgba(15, 23, 42, 0.1);
        padding: 0.3rem;
    }

    .ims-filter-officer-dropdown .dropdown-item {
        border-radius: 0.62rem;
        padding: 0.52rem 0.62rem;
        font-size: 0.76rem;
    }

    .ims-confirm-modal .modal-content {
        border-radius: 1rem;
    }

    .ims-confirm-modal .btn-close {
        position: absolute;
        top: 0.9rem;
        right: 0.9rem;
        z-index: 2;
    }

    @media (max-width: 991.98px) {
        .ims-toolbar {
            padding: 0.7rem 0.9rem !important;
        }

        .ims-toolbar-actions {
            width: 100%;
            justify-content: flex-start;
        }

        .ims-toolbar-actions .btn {
            flex: 1 1 calc(50% - 0.3rem);
        }

        .ims-stats-wrap,
        .ims-filter-summary-strip,
        .ims-records-shell {
            margin-left: 0;
            margin-right: 0;
        }

        .ims-filter-summary-strip {
            margin-left: 0.9rem;
            margin-right: 0.9rem;
        }

        .ims-records-shell {
            padding-left: 0.9rem;
            padding-right: 0.9rem;
        }

        .ims-article-search-group {
            max-width: none;
        }
    }

    @media (max-width: 767.98px) {
        .ims-toolbar {
            padding: 0.72rem 0.82rem !important;
        }

        .ims-toolbar > .d-flex {
            gap: 0.68rem !important;
        }

        .ims-toolbar-meta {
            width: 100%;
            justify-content: flex-start;
        }

        .ims-toolbar-actions .btn {
            flex: 1 1 calc(50% - 0.28rem);
        }

        .ims-stats-wrap {
            padding: 0.55rem 0.82rem !important;
        }

        .ims-stat-card-body {
            padding: 0.72rem 0.8rem !important;
        }

        .ims-stat-value {
            font-size: 1.16rem !important;
        }

        .ims-filter-summary-strip {
            margin: 0 0.82rem 0.55rem;
            padding: 0.65rem 0.72rem;
        }

        .ims-records-shell,
        .ims-mobile-list {
            padding-left: 0.82rem;
            padding-right: 0.82rem;
        }

        .ims-mobile-card-top {
            flex-direction: column;
        }

        .ims-mobile-card-value {
            text-align: left;
            min-width: 0;
        }

        .ims-mobile-card-grid,
        .ims-mobile-card-extra,
        .ims-mobile-card-actions {
            grid-template-columns: 1fr;
        }

        .ims-modal-body-soft,
        .ims-filter-body,
        .ims-article-body {
            padding: 0.92rem 0.92rem 1rem;
        }

        .ims-modal-footer,
        .ims-filter-footer,
        .ims-article-form-actions,
        .ims-create-actions {
            flex-wrap: wrap;
        }

        .ims-modal-footer .btn,
        .ims-filter-footer .btn,
        .ims-article-form-actions .btn,
        .ims-create-actions .btn {
            width: 100%;
            min-width: 0;
        }

        .ims-classification-grid .form-label {
            min-height: 0;
        }
    }

    /* IMS FINAL UI POLISH START */
    .ims-page,
    .ims-page-row,
    .ims-page-col,
    .ims-main-card {
        min-height: 0;
    }

    .ims-main-card {
        border: 0;
        border-radius: 0;
        box-shadow: none;
        background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);
    }

    .ims-toolbar {
        padding: 0.56rem 0.9rem !important;
        background: rgba(255, 255, 255, 0.96);
        backdrop-filter: blur(10px);
    }

    .ims-toolbar > .d-flex {
        gap: 0.65rem !important;
    }

    .ims-toolbar-meta {
        gap: 0.15rem;
        font-size: 0.78rem;
        font-weight: 600;
        color: #475569;
    }

    .ims-toolbar-actions {
        gap: 0.45rem !important;
    }

    .ims-toolbar-actions .btn,
    .ims-summary-clear-btn {
        min-height: 2.15rem;
        border-radius: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.01em;
    }

    .ims-stats-wrap {
        padding: 0.5rem 0.9rem 0.58rem !important;
        background: transparent !important;
    }

    .ims-stat-card {
        border-radius: 0.95rem;
        overflow: hidden;
        box-shadow: 0 12px 24px rgba(15, 23, 42, 0.05) !important;
    }

    .ims-stat-card-body {
        min-height: 4.65rem;
        display: flex;
        align-items: center;
        padding: 0.72rem 0.86rem !important;
    }

    .ims-stat-label {
        font-size: 0.72rem;
        letter-spacing: 0.01em;
    }

    .ims-stat-value {
        font-size: 1.18rem !important;
        letter-spacing: -0.02em;
    }

    .ims-filter-summary-strip {
        margin: 0.08rem 0.9rem 0.55rem;
        padding: 0.55rem 0.7rem;
        box-shadow: 0 12px 22px rgba(15, 23, 42, 0.04);
    }

    .ims-records-shell {
        padding: 0 0.9rem 0.55rem;
        gap: 0.45rem;
    }

    .ims-table-panel {
        box-shadow: 0 18px 34px rgba(15, 23, 42, 0.05);
    }

    .ims-table-wrap {
        padding: 0.38rem 0 0.18rem;
        scrollbar-gutter: stable;
    }

    .inventory-table {
        min-width: 1600px;
    }

    .inventory-table thead th {
        position: sticky;
        box-shadow: inset 0 -1px 0 #dbe4ee;
        letter-spacing: 0.04em;
    }

    .inventory-table tbody td {
        line-height: 1.35;
    }

    .inventory-table tbody td.specification-cell .specification-content {
        display: inline-flex;
        max-width: 100%;
        align-items: center;
        justify-content: center;
        gap: 0.24rem;
    }

    .inventory-table tbody td.specification-cell.is-expanded .specification-content {
        display: inline;
    }

    .inventory-table tbody td.specification-cell .specification-cell-text {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .inventory-table tbody td.specification-cell.is-expanded .specification-cell-text {
        display: inline;
        max-width: none;
        white-space: normal;
    }

    .inventory-table tbody td.specification-cell .specification-toggle-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.18rem;
        color: #2563eb;
        font-weight: 700;
        text-decoration: none;
    }

    .ims-table-footer {
        padding: 0.44rem 0.9rem 0.35rem !important;
    }

    .ims-table-footer-inner {
        min-height: 2.25rem;
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }

    .ims-table-footer .pagination {
        gap: 0.22rem;
    }

    .ims-table-footer .pagination .page-link {
        min-width: 1.95rem;
        height: 1.95rem;
        border-radius: 0.62rem;
        font-size: 0.8rem;
        font-weight: 700;
    }

    .ims-mobile-list {
        padding: 0 0.9rem 0.75rem;
        gap: 0.75rem;
    }

    .ims-mobile-card {
        border-radius: 1rem;
        box-shadow: 0 14px 28px rgba(15, 23, 42, 0.06);
    }

    .ims-modal-content {
        border-radius: 1.1rem;
        overflow: hidden;
        box-shadow: 0 30px 60px rgba(15, 23, 42, 0.14);
    }

    .ims-modal-header,
    .ims-filter-header,
    .ims-article-header {
        padding: 1rem 1.1rem 0.88rem;
        background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
    }

    .ims-modal-title,
    .ims-article-heading-title,
    .ims-filter-title {
        letter-spacing: -0.02em;
    }

    .ims-modal-subtitle,
    .ims-article-heading-subtitle,
    .ims-filter-subtitle {
        max-width: 60ch;
    }

    .ims-modal-body-soft,
    .ims-filter-body,
    .ims-article-body {
        padding: 1rem 1.1rem 1.05rem;
        background: #f8fafc;
    }

    .ims-form-panel,
    .ims-filter-section,
    .ims-article-section-card {
        border-radius: 1rem;
        box-shadow: 0 10px 24px rgba(15, 23, 42, 0.05);
    }

    .ims-form-panel {
        padding: 1rem;
    }

    .ims-form-panel-head,
    .ims-article-section-head,
    .ims-filter-section-head {
        margin-bottom: 0.95rem;
    }

    .ims-form-panel-title,
    .ims-create-property-title,
    .ims-article-section-title,
    .ims-filter-section-title {
        letter-spacing: -0.02em;
    }

    .ims-form-panel-subtitle,
    .ims-article-section-subtitle,
    .ims-filter-section-subtitle {
        max-width: 62ch;
    }

    .ims-form-panel .form-control,
    .ims-form-panel .form-select,
    .ims-filter-control,
    .ims-article-form .form-control,
    .ims-article-form .form-select {
        min-height: 2.6rem;
        border-radius: 0.75rem;
    }

    .ims-classification-grid .form-label {
        min-height: 1.45rem;
        display: flex;
        align-items: center;
        gap: 0.45rem;
    }

    .ims-field-chip {
        align-self: center;
    }

    .ims-inline-helper-card {
        padding: 0.72rem 0.85rem;
        border-radius: 0.82rem;
        background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
    }

    .ims-article-tabs {
        gap: 0.45rem;
        padding: 0.22rem;
        border-radius: 0.95rem;
        background: #edf4ff;
    }

    .ims-article-tabs .nav-link {
        min-height: 2.35rem;
        border-radius: 0.78rem;
        font-weight: 700;
    }

    .ims-article-list-toolbar {
        gap: 0.75rem;
    }

    .ims-filter-modal .modal-content .input-group {
        min-height: 2.6rem;
    }

    @media (max-width: 991.98px) {
        .ims-toolbar {
            padding: 0.72rem 0.9rem !important;
        }

        .ims-toolbar-actions {
            width: 100%;
        }

        .ims-toolbar-actions .btn {
            flex: 1 1 calc(50% - 0.25rem);
        }

        .ims-records-shell {
            padding-left: 0.9rem;
            padding-right: 0.9rem;
        }
    }

    @media (max-width: 767.98px) {
        .ims-toolbar {
            padding: 0.78rem 0.82rem !important;
        }

        .ims-stats-wrap,
        .ims-filter-summary-strip,
        .ims-records-shell,
        .ims-mobile-list {
            padding-left: 0.82rem;
            padding-right: 0.82rem;
        }

        .ims-filter-summary-strip {
            margin: 0.1rem 0.82rem 0.55rem;
        }

        .ims-modal-header,
        .ims-filter-header,
        .ims-article-header {
            padding: 0.92rem 0.92rem 0.82rem;
        }

        .ims-modal-body-soft,
        .ims-filter-body,
        .ims-article-body {
            padding: 0.92rem;
        }

        .ims-form-panel,
        .ims-filter-section,
        .ims-article-section-card {
            padding: 0.88rem;
            box-shadow: none;
        }
    }

    /* IMS CONCEPT: Compact Operations Desk + Data Grid Pro + Clean Government Pro */
    .ims-main-card {
        background: linear-gradient(180deg, #f4f8fb 0%, #edf3f7 100%);
    }

    .ims-toolbar {
        margin: 0.5rem 0.9rem 0.45rem;
        padding: 0.58rem 0.78rem !important;
        border: 1px solid #d7e3ef !important;
        border-radius: 1rem;
        background: rgba(255, 255, 255, 0.95);
        box-shadow: 0 12px 24px rgba(15, 23, 42, 0.04);
    }

    .ims-toolbar > .d-flex {
        gap: 0.65rem !important;
        justify-content: space-between;
    }

    .ims-toolbar-meta {
        gap: 0.22rem;
        padding: 0.26rem 0.38rem;
        border: 1px solid #e2e8f0;
        border-radius: 0.85rem;
        background: #f8fbfd;
        color: #425466;
        font-size: 0.76rem;
        font-weight: 600;
    }

    .ims-per-page-select {
        min-width: 74px;
        min-height: 2rem;
        border-radius: 0.72rem;
        border-color: #d3dfeb;
        background: #ffffff;
        box-shadow: none;
    }

    .ims-toolbar-actions {
        gap: 0.45rem !important;
    }

    .ims-toolbar-actions .btn,
    .ims-summary-clear-btn {
        min-height: 2.15rem;
        padding: 0.44rem 0.82rem;
        border-radius: 0.72rem;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.01em;
        box-shadow: none;
    }

    .ims-btn-primary {
        background: linear-gradient(180deg, #159957 0%, #12804b 100%);
        border-color: #12804b;
        color: #ffffff;
    }

    .ims-btn-primary:hover {
        background: linear-gradient(180deg, #128a50 0%, #0f7344 100%);
        border-color: #0f7344;
        color: #ffffff;
    }

    .ims-btn-secondary {
        background: #edf5ff;
        border-color: #bfd5ee;
        color: #0f4c81;
    }

    .ims-btn-secondary:hover {
        background: #dfedff;
        border-color: #aac7eb;
        color: #0f4c81;
    }

    .ims-btn-tertiary {
        background: #ffffff;
        border-color: #d7e3ef;
        color: #475569;
    }

    .ims-btn-tertiary:hover,
    .ims-summary-clear-btn:hover {
        background: #f8fbfd;
        border-color: #bfd0e2;
        color: #334155;
    }

    .ims-stats-wrap {
        padding: 0 0.9rem 0.5rem !important;
        background: transparent !important;
    }

    .ims-stats-wrap .row {
        --bs-gutter-x: 0.6rem;
        --bs-gutter-y: 0.6rem;
    }

    .ims-stat-card {
        border: 1px solid #d7e3ef !important;
        border-radius: 0.95rem;
        background: linear-gradient(180deg, #ffffff 0%, #f8fbfe 100%);
        box-shadow: 0 12px 22px rgba(15, 23, 42, 0.04) !important;
    }

    .ims-stat-card-body {
        min-height: 4rem;
        padding: 0.72rem 0.8rem !important;
        display: flex;
        align-items: center;
    }

    .ims-stat-label {
        font-size: 0.71rem;
        font-weight: 700;
        color: #52667b;
        letter-spacing: 0.02em;
    }

    .ims-stat-value {
        font-size: 1.16rem !important;
        letter-spacing: -0.025em;
    }

    .ims-stat-icon {
        width: 2.45rem;
        height: 2.45rem;
        margin-left: 0.6rem;
        border-radius: 0.85rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #f1f5f9;
        opacity: 1 !important;
    }

    .ims-stat-icon i {
        font-size: 1.08rem !important;
    }

    .ims-filter-summary-strip {
        margin: 0 0.9rem 0.55rem;
        padding: 0.56rem 0.72rem;
        border: 1px solid #d8e4ef;
        border-radius: 0.92rem;
        background: #ffffff;
        box-shadow: 0 12px 22px rgba(15, 23, 42, 0.04);
    }

    .ims-filter-summary-title {
        font-size: 0.8rem;
        font-weight: 800;
        letter-spacing: 0.01em;
        color: #16324f;
    }

    .ims-filter-summary-subtitle {
        font-size: 0.68rem;
        color: #64748b;
    }

    .ims-filter-chip {
        padding: 0.28rem 0.52rem;
        border-color: #d9e4ef;
        background: #f8fbfd;
        color: #425466;
        font-size: 0.68rem;
    }

    .ims-filter-chip-label {
        color: #1d4f91;
    }

    .ims-records-shell {
        padding: 0 0.9rem 0.52rem;
        gap: 0.32rem;
    }

    .ims-records-head {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        padding: 0.05rem 0.18rem 0.2rem;
    }

    .ims-records-title {
        margin: 0;
        font-size: 0.78rem;
        font-weight: 800;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: #27445c;
    }

    .ims-records-subtitle {
        margin: 0.18rem 0 0;
        font-size: 0.69rem;
        color: #64748b;
    }

    .ims-table-panel {
        border: 1px solid #d7e3ef;
        border-radius: 1rem;
        background: #ffffff;
        box-shadow: 0 18px 34px rgba(15, 23, 42, 0.05);
    }

    .ims-table-wrap {
        padding: 0;
        scrollbar-gutter: stable;
    }

    .inventory-table {
        min-width: 1560px;
        background: #ffffff;
    }

    .inventory-table thead th {
        position: sticky;
        top: 0;
        z-index: 3;
        padding: 0.78rem 0.52rem !important;
        background: linear-gradient(180deg, #f9fbfd 0%, #edf3f8 100%) !important;
        border-bottom: 1px solid #d7e3ef !important;
        box-shadow: inset 0 -1px 0 #d7e3ef;
        color: #29445d;
        font-size: 0.66rem;
        font-weight: 800;
        letter-spacing: 0.05em;
        text-align: center !important;
    }

    .inventory-table tbody td {
        padding: 0.76rem 0.58rem !important;
        border-bottom: 1px solid #edf2f7 !important;
        font-size: 0.74rem;
        color: #334155;
        text-align: center !important;
        vertical-align: middle;
        line-height: 1.38;
        background: #ffffff;
    }

    .inventory-table tbody tr:nth-child(even) td {
        background: #fbfcfd;
    }

    .inventory-table tbody tr:hover td {
        background: #eef6fb !important;
    }

    .inventory-table tbody td:nth-child(1) {
        font-weight: 700;
        color: #16324f;
    }

    .inventory-table tbody td:nth-child(2),
    .inventory-table tbody td:nth-child(8),
    .inventory-table tbody td:nth-child(13) {
        color: #5a6f85;
    }

    .inventory-table tbody td:nth-child(6) {
        font-weight: 700;
        color: #0f9d4d;
    }

    .inventory-table tbody td.specification-cell,
    .inventory-table th:nth-child(3),
    .inventory-table td:nth-child(3) {
        width: 220px;
        min-width: 220px;
        max-width: 220px;
    }

    .inventory-table tbody td.specification-cell .specification-content {
        display: inline-flex;
        max-width: 100%;
        align-items: center;
        justify-content: center;
        gap: 0.24rem;
    }

    .inventory-table tbody td.specification-cell.is-expanded .specification-content {
        display: inline;
    }

    .inventory-table tbody td.specification-cell .specification-cell-text {
        display: inline-block;
        max-width: calc(100% - 3rem);
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        vertical-align: baseline;
    }

    .inventory-table tbody td.specification-cell.is-expanded .specification-cell-text {
        display: inline;
        max-width: none;
        white-space: normal;
    }

    .inventory-table tbody td.specification-cell .specification-toggle-btn {
        display: inline-flex;
        align-items: center;
        padding: 0;
        border: 0;
        background: transparent;
        color: #2563eb;
        font-size: 0.68rem;
        font-weight: 700;
        text-decoration: none;
        white-space: nowrap;
    }

    .inventory-table tbody td .badge {
        font-weight: 700;
        letter-spacing: 0.01em;
        border-radius: 999px;
    }

    .date-badge {
        border: 1px solid #d8e4ef !important;
        background: #f9fbfd !important;
        color: #16324f !important;
    }

    .ims-action-cell .dropdown {
        display: flex;
        justify-content: center;
    }

    .action-dropdown-btn {
        min-width: 88px;
        height: 2rem;
        border-radius: 0.68rem;
        font-size: 0.72rem;
        font-weight: 700;
        background: linear-gradient(180deg, #159957 0%, #12804b 100%);
        border-color: #12804b;
        box-shadow: none;
    }

    .action-dropdown-menu {
        border: 1px solid #d8e4ef;
        border-radius: 0.9rem;
        padding: 0.35rem;
        box-shadow: 0 18px 36px rgba(15, 23, 42, 0.12);
    }

    .action-dropdown-menu .dropdown-item {
        padding: 0.48rem 0.62rem;
        border-radius: 0.68rem;
        font-size: 0.74rem;
    }

    .ims-table-footer {
        padding: 0.38rem 0.9rem 0.28rem !important;
        background: transparent !important;
    }

    .ims-table-footer-inner {
        min-height: 2.2rem;
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }

    .ims-table-footer .pagination {
        gap: 0.22rem;
        margin: 0;
    }

    .ims-table-footer .pagination .page-link {
        min-width: 1.95rem;
        height: 1.95rem;
        border-radius: 0.62rem;
        border: 1px solid #d7e3ef;
        background: #ffffff;
        color: #51657a;
        font-size: 0.8rem;
        font-weight: 700;
        box-shadow: none;
    }

    .ims-table-footer .pagination .page-item.active .page-link {
        background: #2563eb;
        border-color: #2563eb;
        color: #ffffff;
        box-shadow: 0 10px 20px rgba(37, 99, 235, 0.2);
    }

    .ims-mobile-list {
        padding: 0 0.9rem 0.72rem;
        gap: 0.75rem;
    }

    .ims-mobile-card {
        border: 1px solid #d7e3ef;
        border-radius: 1rem;
        background: linear-gradient(180deg, #ffffff 0%, #fbfdff 100%);
        box-shadow: 0 14px 28px rgba(15, 23, 42, 0.05);
    }

    .ims-mobile-card-kicker,
    .ims-mobile-meta-label {
        color: #64748b;
        letter-spacing: 0.05em;
    }

    .ims-mobile-card-title {
        color: #16324f;
    }

    .ims-mobile-card-subtitle,
    .ims-mobile-meta-value {
        color: #425466;
    }

    .ims-mobile-card-details {
        border-top: 1px solid #e7edf4;
    }

    .ims-mobile-card-details summary {
        color: #1d4f91;
        font-weight: 700;
    }

    .ims-mobile-card-actions .btn {
        min-height: 2.2rem;
        border-radius: 0.72rem;
        font-weight: 700;
    }

    .ims-modal-content,
    .ims-filter-modal .modal-content,
    .ims-article-modal {
        border: 1px solid #d7e3ef;
        border-radius: 1.08rem;
        overflow: hidden;
        box-shadow: 0 30px 60px rgba(15, 23, 42, 0.14);
        background: #f7fafc;
    }

    .ims-modal-header,
    .ims-filter-header,
    .ims-article-header {
        padding: 1rem 1.1rem 0.88rem;
        border-bottom: 1px solid #e5edf5 !important;
        background: linear-gradient(180deg, #ffffff 0%, #f8fbfd 100%);
    }

    .ims-modal-title,
    .ims-article-heading-title,
    .ims-filter-title {
        font-size: 1.18rem;
        font-weight: 800;
        color: #16324f;
        letter-spacing: -0.025em;
    }

    .ims-modal-subtitle,
    .ims-article-heading-subtitle,
    .ims-filter-subtitle {
        max-width: 62ch;
        color: #64748b;
        font-size: 0.76rem;
        line-height: 1.5;
    }

    .ims-modal-body-soft,
    .ims-filter-body,
    .ims-article-body {
        padding: 1rem 1.1rem 1.05rem;
        background: #f4f8fb;
    }

    .ims-form-panel,
    .ims-filter-section,
    .ims-article-section-card {
        border: 1px solid #dbe5ef;
        border-radius: 1rem;
        background: #ffffff;
        box-shadow: 0 10px 24px rgba(15, 23, 42, 0.05);
    }

    .ims-form-panel {
        padding: 1rem;
    }

    .ims-form-panel-head,
    .ims-article-section-head,
    .ims-filter-section-head {
        margin-bottom: 0.95rem;
        padding-bottom: 0.82rem;
        border-bottom: 1px solid #edf2f7;
    }

    .ims-create-property-title,
    .ims-form-panel-title,
    .ims-article-section-title,
    .ims-filter-section-title {
        font-size: 0.95rem;
        font-weight: 800;
        letter-spacing: -0.02em;
        color: #16324f;
    }

    .ims-form-panel-subtitle,
    .ims-article-section-subtitle,
    .ims-filter-section-subtitle {
        max-width: 62ch;
        color: #64748b;
        font-size: 0.74rem;
        line-height: 1.5;
    }

    .ims-form-panel .form-label,
    .ims-filter-label,
    .ims-article-form .form-label {
        font-size: 0.76rem;
        font-weight: 700;
        color: #334155;
        margin-bottom: 0.4rem;
    }

    .ims-form-panel .form-control,
    .ims-form-panel .form-select,
    .ims-filter-control,
    .ims-article-form .form-control,
    .ims-article-form .form-select {
        min-height: 2.6rem;
        border: 1px solid #d4dfeb;
        border-radius: 0.75rem;
        background: #fcfdff;
        box-shadow: none;
    }

    .ims-form-panel .form-control:focus,
    .ims-form-panel .form-select:focus,
    .ims-filter-control:focus,
    .ims-article-form .form-control:focus,
    .ims-article-form .form-select:focus {
        border-color: #93c5fd;
        box-shadow: 0 0 0 0.18rem rgba(59, 130, 246, 0.12);
    }

    .ims-readonly-field {
        background: #f1f5f9 !important;
        color: #52667b !important;
        font-weight: 600;
    }

    .ims-classification-grid .form-label {
        min-height: 1.45rem;
        display: flex;
        align-items: center;
        gap: 0.42rem;
    }

    .ims-field-chip {
        padding: 0.16rem 0.4rem;
        border: 1px solid #c8daf4;
        border-radius: 999px;
        background: #edf5ff;
        color: #1d4f91;
        font-size: 0.64rem;
        font-weight: 800;
        letter-spacing: 0.02em;
        text-transform: uppercase;
        align-self: center;
    }

    .ims-inline-helper-card {
        padding: 0.7rem 0.85rem;
        border: 1px dashed #d4dfeb;
        border-radius: 0.82rem;
        background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
        color: #607386;
        font-size: 0.72rem;
    }

    .ims-article-tabs {
        gap: 0.45rem;
        padding: 0.22rem;
        border: 1px solid #d8e4ef;
        border-radius: 0.98rem;
        background: #eef4f9;
    }

    .ims-article-tabs .nav-link {
        min-height: 2.35rem;
        border-radius: 0.78rem;
        color: #52667b;
        font-weight: 700;
    }

    .ims-article-tabs .nav-link.active {
        background: #ffffff;
        color: #16324f;
        box-shadow: 0 10px 18px rgba(15, 23, 42, 0.07);
    }

    .ims-article-list-toolbar {
        gap: 0.75rem;
    }

    .ims-article-table-wrap {
        border: 1px solid #e5edf5;
        border-radius: 0.88rem;
        background: #fbfdff;
    }

    .ims-article-table thead th {
        background: #f8fbfd;
        color: #456078;
        font-size: 0.7rem;
        font-weight: 800;
        letter-spacing: 0.04em;
        text-transform: uppercase;
    }

    .ims-filter-modal .modal-content .input-group {
        min-height: 2.6rem;
    }

    .ims-filter-officer-dropdown {
        border-color: #d7e3ef;
        border-radius: 0.82rem;
        background: #ffffff;
    }

    .ims-filter-officer-dropdown .dropdown-item:hover {
        background: #f0f7ff;
        color: #16324f;
    }

    @media (max-width: 991.98px) {
        .ims-toolbar {
            margin: 0.48rem 0.9rem 0.42rem;
            padding: 0.68rem 0.82rem !important;
        }

        .ims-toolbar-actions {
            width: 100%;
            justify-content: flex-start;
        }

        .ims-toolbar-actions .btn {
            flex: 1 1 calc(50% - 0.25rem);
        }

        .ims-records-shell {
            padding-left: 0.9rem;
            padding-right: 0.9rem;
        }
    }

    @media (max-width: 767.98px) {
        .ims-toolbar {
            margin: 0.42rem 0.82rem 0.42rem;
            padding: 0.74rem 0.78rem !important;
        }

        .ims-toolbar-meta {
            width: 100%;
            justify-content: flex-start;
        }

        .ims-stats-wrap,
        .ims-records-shell,
        .ims-mobile-list {
            padding-left: 0.82rem;
            padding-right: 0.82rem;
        }

        .ims-filter-summary-strip {
            margin: 0 0.82rem 0.5rem;
        }

        .ims-records-head {
            padding-left: 0;
            padding-right: 0;
        }

        .ims-records-subtitle {
            max-width: none;
        }

        .ims-mobile-card-top {
            flex-direction: column;
        }

        .ims-mobile-card-value {
            text-align: left;
            min-width: 0;
        }

        .ims-mobile-card-grid,
        .ims-mobile-card-extra,
        .ims-mobile-card-actions {
            grid-template-columns: 1fr;
        }

        .ims-modal-header,
        .ims-filter-header,
        .ims-article-header {
            padding: 0.92rem 0.92rem 0.82rem;
        }

        .ims-modal-body-soft,
        .ims-filter-body,
        .ims-article-body {
            padding: 0.92rem;
        }

        .ims-form-panel,
        .ims-filter-section,
        .ims-article-section-card {
            padding: 0.88rem;
            box-shadow: none;
        }
    }

    /* IMS FULL POLISH PASS */
    .ims-main-card {
        background: linear-gradient(180deg, #f4f7fb 0%, #edf3f7 46%, #eef4f8 100%);
    }

    .ims-toolbar-actions .btn i,
    .ims-summary-clear-btn i {
        font-size: 0.82rem;
    }

    .ims-toolbar-actions .btn span,
    .ims-summary-clear-btn span {
        line-height: 1;
    }

    .ims-stats-wrap .col-sm-4:nth-child(1) .ims-stat-card::before,
    .ims-stats-wrap .col-sm-4:nth-child(2) .ims-stat-card::before,
    .ims-stats-wrap .col-sm-4:nth-child(3) .ims-stat-card::before {
        content: '';
        position: absolute;
        inset: 0 auto 0 0;
        width: 4px;
        border-radius: 999px;
    }

    .ims-stats-wrap .col-sm-4:nth-child(1) .ims-stat-card::before {
        background: linear-gradient(180deg, #2563eb 0%, #60a5fa 100%);
    }

    .ims-stats-wrap .col-sm-4:nth-child(2) .ims-stat-card::before {
        background: linear-gradient(180deg, #0ea5e9 0%, #7dd3fc 100%);
    }

    .ims-stats-wrap .col-sm-4:nth-child(3) .ims-stat-card::before {
        background: linear-gradient(180deg, #16a34a 0%, #86efac 100%);
    }

    .ims-stat-card {
        position: relative;
    }

    .ims-stat-card-body .d-flex {
        width: 100%;
        justify-content: space-between;
    }

    .ims-filter-summary-head {
        align-items: center;
    }

    .ims-filter-chip-row {
        gap: 0.35rem;
    }

    .ims-records-title {
        position: relative;
        padding-left: 0.72rem;
    }

    .ims-records-title::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        width: 0.34rem;
        height: 0.95rem;
        transform: translateY(-50%);
        border-radius: 999px;
        background: linear-gradient(180deg, #2563eb 0%, #16a34a 100%);
    }

    .ims-table-panel {
        overflow: hidden;
    }

    .ims-table-wrap,
    .ims-mobile-list,
    .ims-article-table-wrap,
    .ims-filter-body,
    .ims-article-body,
    .ims-modal-body-soft {
        scrollbar-width: thin;
        scrollbar-color: #94a3b8 #e2e8f0;
    }

    .ims-table-wrap::-webkit-scrollbar,
    .ims-mobile-list::-webkit-scrollbar,
    .ims-article-table-wrap::-webkit-scrollbar,
    .ims-filter-body::-webkit-scrollbar,
    .ims-article-body::-webkit-scrollbar,
    .ims-modal-body-soft::-webkit-scrollbar {
        width: 0.62rem;
        height: 0.62rem;
    }

    .ims-table-wrap::-webkit-scrollbar-track,
    .ims-mobile-list::-webkit-scrollbar-track,
    .ims-article-table-wrap::-webkit-scrollbar-track,
    .ims-filter-body::-webkit-scrollbar-track,
    .ims-article-body::-webkit-scrollbar-track,
    .ims-modal-body-soft::-webkit-scrollbar-track {
        background: #e2e8f0;
        border-radius: 999px;
    }

    .ims-table-wrap::-webkit-scrollbar-thumb,
    .ims-mobile-list::-webkit-scrollbar-thumb,
    .ims-article-table-wrap::-webkit-scrollbar-thumb,
    .ims-filter-body::-webkit-scrollbar-thumb,
    .ims-article-body::-webkit-scrollbar-thumb,
    .ims-modal-body-soft::-webkit-scrollbar-thumb {
        background: #94a3b8;
        border-radius: 999px;
    }

    .inventory-table thead th .fa-solid {
        font-size: 0.64rem;
    }

    .inventory-table tbody td {
        transition: background-color 0.18s ease, color 0.18s ease;
    }

    .inventory-table tbody tr:hover td:nth-child(1) {
        color: #0f3d6d;
    }

    .inventory-table tbody td.specification-cell .specification-toggle-btn:hover {
        color: #1d4ed8;
        text-decoration: underline;
    }

    .action-dropdown-menu .dropdown-item:hover {
        background: #f0f7ff;
        color: #16324f;
    }

    .ims-table-footer {
        border-top: 1px solid #e7edf4 !important;
    }

    .ims-table-footer .pagination .page-link:hover {
        border-color: #bfd5ee;
        background: #eff6ff;
        color: #1d4f91;
    }

    .ims-mobile-card-top {
        gap: 0.72rem;
    }

    .ims-mobile-card-value strong {
        letter-spacing: -0.02em;
    }

    .ims-mobile-card-actions .btn {
        box-shadow: none;
    }

    .ims-modal-header-group,
    .ims-article-heading,
    .ims-filter-heading {
        display: flex;
        flex-direction: column;
        gap: 0.18rem;
    }

    .ims-modal-header .btn-close,
    .ims-filter-header .btn-close,
    .ims-article-header .btn-close {
        opacity: 0.72;
        background-size: 0.72rem;
    }

    .ims-modal-footer,
    .ims-filter-footer {
        padding: 0.85rem 1.1rem 0.95rem;
        border-top: 1px solid #e5edf5;
        background: #ffffff;
        gap: 0.55rem;
    }

    .ims-modal-footer .btn,
    .ims-filter-footer .btn,
    .ims-create-actions .btn,
    .ims-article-form-actions .btn {
        min-height: 2.2rem;
        border-radius: 0.75rem;
        font-weight: 700;
    }

    .ims-filter-clear-link {
        font-size: 0.74rem;
        font-weight: 700;
        color: #1d4f91;
        text-decoration: none;
    }

    .ims-filter-clear-link:hover {
        color: #16324f;
        text-decoration: underline;
    }

    .ims-form-shell {
        display: flex;
        flex-direction: column;
        gap: 0.95rem;
    }

    .ims-form-panel .text-danger,
    .ims-form-panel .invalid-feedback,
    .ims-article-form .invalid-feedback,
    .ims-filter-body .invalid-feedback {
        font-size: 0.72rem;
        margin-top: 0.3rem;
    }

    .ims-currency-input-group .input-group-text,
    .ims-currency-input-group .ims-currency-clear {
        border-color: #d4dfeb;
        background: #f8fbfd;
        color: #334155;
        font-weight: 700;
    }

    .ims-currency-input-group .form-control {
        background: #ffffff;
    }

    .ims-unit-value-chip {
        border-radius: 999px;
        font-size: 0.68rem;
        font-weight: 800;
        letter-spacing: 0.02em;
        text-transform: uppercase;
    }

    .ims-article-search-group .btn,
    .ims-article-search-group .form-control {
        min-height: 2.1rem;
    }

    .ims-article-empty {
        padding: 1rem 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.45rem;
        color: #64748b;
        font-size: 0.74rem;
    }

    .ims-filter-helper {
        margin-top: 0.38rem;
        font-size: 0.71rem;
    }

    @media (max-width: 767.98px) {
        .ims-modal-footer,
        .ims-filter-footer {
            padding: 0.82rem 0.92rem 0.92rem;
        }

        .ims-records-title {
            padding-left: 0.64rem;
        }

        .ims-records-title::before {
            height: 0.82rem;
        }
    }
    /* IMS FINAL UI POLISH END */
/* IMS FINAL UI REFRESH END */
    /* IMS ARTICLE MODAL SCROLL FIX */
    .ims-article-body {
        max-height: calc(100vh - 12.5rem);
        overflow-y: auto;
        overscroll-behavior: contain;
    }

    .ims-article-table-wrap {
        max-height: 272px;
        overflow: auto;
        -webkit-overflow-scrolling: touch;
    }

    @media (max-width: 767.98px) {
        .ims-article-body {
            max-height: calc(100vh - 10rem);
        }

        .ims-article-table-wrap {
            max-height: 220px;
        }
    }
    .ims-article-table tbody tr.ims-recent-row td {
        background: #edf9f1 !important;
    }

    .ims-article-table tbody tr.ims-recent-row:hover td {
        background: #e4f4ea !important;
    }
    .ims-article-list-card {
        position: relative;
    }

    .ims-article-edit-row td {
        background: #fff3e8 !important;
        border-color: #fed7aa !important;
    }

    .ims-article-delete-target-row td {
        background: #fff1f2 !important;
        border-color: #fecdd3 !important;
    }

    .ims-article-edit-input {
        min-height: 2.15rem;
        border-radius: 0.55rem;
        border-color: #d7e3f4;
        background: #ffffff;
        box-shadow: 0 1px 2px rgba(15, 23, 42, 0.04);
    }

    .ims-inline-actions-group {
        display: inline-flex;
        align-items: center;
        justify-content: flex-end;
        gap: 0.45rem;
    }

    .ims-inline-actions-group-edit .btn {
        min-width: 78px;
    }

    .ims-article-confirm-overlay {
        position: absolute;
        inset: 0;
        z-index: 12;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        background: rgba(15, 23, 42, 0.28);
        backdrop-filter: blur(2px);
    }

    .ims-article-confirm-card {
        width: min(420px, 100%);
        border: 1px solid #fecaca;
        border-radius: 1rem;
        background: #ffffff;
        box-shadow: 0 24px 48px rgba(15, 23, 42, 0.18);
        padding: 1rem 1rem 0.95rem;
    }

    .ims-article-confirm-icon {
        width: 2.6rem;
        height: 2.6rem;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #fff1f2;
        color: #dc2626;
        font-size: 1rem;
        margin-bottom: 0.75rem;
    }

    .ims-article-confirm-title {
        margin: 0 0 0.35rem;
        font-size: 1rem;
        font-weight: 800;
        color: #0f172a;
    }

    .ims-article-confirm-text {
        margin: 0;
        color: #334155;
        font-size: 0.92rem;
        line-height: 1.45;
    }

    .ims-article-confirm-subtext {
        display: inline-block;
        margin-top: 0.5rem;
        color: #64748b;
        font-size: 0.76rem;
        line-height: 1.35;
    }

    .ims-article-confirm-actions {
        display: flex;
        justify-content: flex-end;
        gap: 0.55rem;
        margin-top: 1rem;
    }

    .ims-article-confirm-actions .btn {
        min-width: 118px;
        border-radius: 0.7rem;
        font-weight: 700;
    }

    @media (max-width: 767.98px) {
        .ims-article-confirm-card {
            padding: 0.95rem;
        }

        .ims-article-confirm-actions {
            flex-direction: column-reverse;
        }

        .ims-article-confirm-actions .btn {
            width: 100%;
        }
    }
</style>















