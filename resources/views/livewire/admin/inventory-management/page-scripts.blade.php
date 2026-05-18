<script>
(() => {
    if (window.__imsPageScriptsInit) {
        return;
    }
    window.__imsPageScriptsInit = true;

    const getLivewireApi = () => window.Livewire || window.livewire || null;

    const showModal = (id) => {
        const modalEl = document.getElementById(id);
        if (!modalEl || typeof bootstrap === 'undefined') {
            return;
        }
        bootstrap.Modal.getOrCreateInstance(modalEl).show();
    };

    const hideModal = (id) => {
        const modalEl = document.getElementById(id);
        if (!modalEl || typeof bootstrap === 'undefined') {
            return;
        }
        const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
        modal.hide();
    };

    const showArticleTab = (tabId) => {
        const tabButton = document.getElementById(tabId);
        if (!tabButton || typeof bootstrap === 'undefined') {
            return;
        }
        bootstrap.Tab.getOrCreateInstance(tabButton).show();
    };

    const initTooltips = () => {
        if (typeof bootstrap === 'undefined') {
            return;
        }
        document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach((el) => {
            if (!bootstrap.Tooltip.getInstance(el)) {
                new bootstrap.Tooltip(el, {
                    html: true,
                    delay: { show: 200, hide: 100 },
                });
            }
        });
    };

    const routeArticleTabByValidation = () => {
        const articleModal = document.getElementById('article_modal');
        if (!articleModal || !articleModal.classList.contains('show')) {
            return;
        }

        const hasDescriptionErrors = articleModal.querySelector('[wire\\:model\\.defer=\"new_article_id\"].is-invalid, [wire\\:model\\.defer=\"new_article_description\"].is-invalid');
        const hasArticleNameErrors = articleModal.querySelector('#imsNewArticleName.is-invalid, #imsNewArticlePpeUacs.is-invalid, #imsNewArticleSemiExUacs.is-invalid, input[wire\:model\.defer="editingArticleName"].is-invalid, input[wire\:model\.defer="editingArticlePpeUacs"].is-invalid, input[wire\:model\.defer="editingArticleSemiExUacs"].is-invalid');
        const hasRemarkErrors = articleModal.querySelector('[wire\\:model\\.defer=\"new_remark_name\"].is-invalid, [wire\\:model\\.defer=\"editingRemarkName\"].is-invalid');

        if (hasDescriptionErrors) {
            showArticleTab('add_description_tab');
            return;
        }

        if (hasRemarkErrors) {
            showArticleTab('manage_remarks_tab');
            return;
        }

        if (hasArticleNameErrors) {
            showArticleTab('add_article_tab');
        }
    };

    const focusFirstInvalidArticleField = () => {
        const articleModal = document.getElementById('article_modal');
        if (!articleModal || !articleModal.classList.contains('show')) {
            return;
        }

        const activePane = articleModal.querySelector('.tab-pane.show.active');
        if (!activePane) {
            return;
        }

        const invalidField = activePane.querySelector('.is-invalid');
        if (!invalidField || typeof invalidField.focus !== 'function') {
            return;
        }

        requestAnimationFrame(() => invalidField.focus());
    };

    const bindFilterModalHandlers = () => {
        if (window.__imsFilterModalHandlersBound) {
            return;
        }
        window.__imsFilterModalHandlersBound = true;

        const filterModal = document.getElementById('filterModal');
        if (!filterModal) {
            return;
        }

        document.addEventListener('mousedown', (event) => {
            if (!filterModal.classList.contains('show')) {
                return;
            }

            const officerPicker = filterModal.querySelector('.js-ims-officer-picker');
            if (!officerPicker || officerPicker.contains(event.target)) {
                return;
            }

            const livewire = getLivewireApi();
            if (livewire?.emit) {
                livewire.emit('closeModalOfficerDropdown');
            }
        });

        filterModal.addEventListener('hidden.bs.modal', () => {
            const livewire = getLivewireApi();
            if (livewire?.emit) {
                livewire.emit('closeModalOfficerDropdown');
            }
        });
    };

    const bindSpecificationToggleHandlers = () => {
        if (window.__imsSpecificationToggleHandlersBound) {
            return;
        }
        window.__imsSpecificationToggleHandlersBound = true;

        document.addEventListener('click', (event) => {
            const toggleButton = event.target.closest('.specification-toggle-btn');
            if (!toggleButton) {
                return;
            }

            const specificationCell = toggleButton.closest('.specification-cell');
            if (!specificationCell) {
                return;
            }

            const expanded = specificationCell.classList.toggle('is-expanded');
            toggleButton.textContent = expanded ? 'Less' : 'More';
            toggleButton.setAttribute('aria-expanded', expanded ? 'true' : 'false');
        });
    };

    const cleanNumericInput = (value, preserveTrailingDot = false) => {
        const sanitized = (value || '').toString().replace(/,/g, '').replace(/[^0-9.]/g, '');
        if (!sanitized) {
            return '';
        }

        const firstDotIndex = sanitized.indexOf('.');
        if (firstDotIndex === -1) {
            return sanitized;
        }

        const integerPart = sanitized.slice(0, firstDotIndex);
        const decimalPart = sanitized.slice(firstDotIndex + 1).replace(/\./g, '').slice(0, 2);
        const hasTrailingDot = preserveTrailingDot && sanitized.endsWith('.') && decimalPart.length === 0;

        if (hasTrailingDot) {
            return `${integerPart}.`;
        }

        return decimalPart ? `${integerPart}.${decimalPart}` : integerPart;
    };
    const formatCurrencyInputLive = (value) => {
        const raw = cleanNumericInput(value, true);
        if (!raw) {
            return '';
        }

        const hasTrailingDot = raw.endsWith('.');
        const [integerPartRaw = '', decimalPart = ''] = raw.split('.');
        const normalizedInteger = integerPartRaw
            ? integerPartRaw.replace(/^0+(?=\d)/, '')
            : (hasTrailingDot || decimalPart !== '' ? '0' : '');
        const formattedInteger = (normalizedInteger || '0').replace(/\B(?=(\d{3})+(?!\d))/g, ',');

        if (hasTrailingDot) {
            return `${formattedInteger}.`;
        }

        return decimalPart !== '' ? `${formattedInteger}.${decimalPart}` : formattedInteger;
    };
    const formatCurrencyDisplay = (value) => {
        const raw = cleanNumericInput(value);
        if (!raw) {
            return '';
        }
        const numeric = parseFloat(raw);
        return Number.isNaN(numeric)
            ? ''
            : numeric.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    };
    const moveCaretToEnd = (input) => {
        if (!input || typeof input.setSelectionRange !== 'function') {
            return;
        }

        requestAnimationFrame(() => {
            const valueLength = input.value.length;
            input.setSelectionRange(valueLength, valueLength);
        });
    };
    const syncCreateUnitValueThresholdChip = (rawValue) => {
        const display = document.getElementById('createUnitValueDisplay');
        const chip = display
            ? display.closest('.ims-currency-field')?.querySelector('.ims-unit-value-chip')
            : null;

        if (!chip) {
            return;
        }

        const normalized = cleanNumericInput(rawValue);
        const numeric = normalized === '' ? NaN : parseFloat(normalized);
        chip.classList.remove('is-ppe', 'is-semi', 'is-neutral');

        if (normalized === '' || Number.isNaN(numeric)) {
            chip.classList.add('is-neutral');
            chip.textContent = 'Waiting for amount';
            return;
        }

        if (numeric >= 50000) {
            chip.classList.add('is-ppe');
            chip.textContent = 'PPE (50,000 and above)';
            return;
        }

        chip.classList.add('is-semi');
        chip.textContent = 'Semi-ex (below 50,000)';
    };
    const refreshCreateUnitValueState = (rawValue) => {
        const hidden = document.getElementById('createUnitValueHidden');
        const componentElement = hidden ? hidden.closest('[wire\:id]') : null;
        const componentId = componentElement ? componentElement.getAttribute('wire:id') : null;
        const component = componentId && window.Livewire ? window.Livewire.find(componentId) : null;
        if (!component) {
            return;
        }
        component.call('refreshUnitValueState', cleanNumericInput(rawValue || ''));
    };

    const syncEditUnitValueDisplay = () => {
        const display = document.getElementById('editUnitValueDisplay');
        const hidden = document.getElementById('editUnitValueHidden');
        if (!display || !hidden) {
            return;
        }

        const raw = cleanNumericInput(hidden.value);
        if (!raw) {
            display.value = '';
            return;
        }

        const numeric = parseFloat(raw);
        display.value = Number.isNaN(numeric)
            ? ''
            : numeric.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    };

    const syncCreateUnitValueDisplay = () => {
        const display = document.getElementById('createUnitValueDisplay');
        const hidden = document.getElementById('createUnitValueHidden');
        if (!display || !hidden) {
            return;
        }

        syncCreateUnitValueThresholdChip(hidden.value);

        if (document.activeElement === display) {
            return;
        }

        display.value = formatCurrencyDisplay(hidden.value);
    };

    const bindEditUnitValueHandlers = () => {
        if (window.__imsEditUnitValueHandlersBound) {
            return;
        }
        window.__imsEditUnitValueHandlersBound = true;

        document.addEventListener('input', (event) => {
            if (event.target.id !== 'editUnitValueDisplay') {
                return;
            }

            const hidden = document.getElementById('editUnitValueHidden');
            if (!hidden) {
                return;
            }

            const raw = cleanNumericInput(event.target.value);
            hidden.value = raw;
            hidden.dispatchEvent(new Event('input', { bubbles: true }));
        });

        document.addEventListener('focusout', (event) => {
            if (event.target.id !== 'editUnitValueDisplay') {
                return;
            }

            const raw = cleanNumericInput(event.target.value);
            if (!raw) {
                event.target.value = '';
                return;
            }

            const numeric = parseFloat(raw);
            event.target.value = Number.isNaN(numeric)
                ? ''
                : numeric.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        });

        document.addEventListener('click', (event) => {
            const clearButton = event.target.closest('.currency-clear');
            if (!clearButton) {
                return;
            }

            const inputGroup = clearButton.closest('.input-group');
            const display = inputGroup ? inputGroup.querySelector('#editUnitValueDisplay') : null;
            const hidden = document.getElementById('editUnitValueHidden');
            if (!display || !hidden) {
                return;
            }

            display.value = '';
            hidden.value = '';
            hidden.dispatchEvent(new Event('input', { bubbles: true }));
        });
    };

    const bindCreateUnitValueHandlers = () => {
        if (window.__imsCreateUnitValueHandlersBound) {
            return;
        }
        window.__imsCreateUnitValueHandlersBound = true;

        document.addEventListener('input', (event) => {
            if (event.target.id !== 'createUnitValueDisplay') {
                return;
            }

            const hidden = document.getElementById('createUnitValueHidden');
            if (!hidden) {
                return;
            }

            const raw = cleanNumericInput(event.target.value, true);
            hidden.value = raw;
            event.target.value = formatCurrencyInputLive(raw);
            syncCreateUnitValueThresholdChip(raw);
            moveCaretToEnd(event.target);
        });

        document.addEventListener('focusout', (event) => {
            if (event.target.id !== 'createUnitValueDisplay') {
                return;
            }

            const hidden = document.getElementById('createUnitValueHidden');
            const raw = cleanNumericInput(event.target.value);
            if (hidden) {
                hidden.value = raw;
            }

            event.target.value = formatCurrencyDisplay(raw);
            syncCreateUnitValueThresholdChip(raw);
            refreshCreateUnitValueState(raw);
        });

        document.addEventListener('click', (event) => {
            const clearButton = event.target.closest('#createUnitValueClear');
            if (!clearButton) {
                return;
            }

            const display = document.getElementById('createUnitValueDisplay');
            const hidden = document.getElementById('createUnitValueHidden');
            if (!display || !hidden) {
                return;
            }

            display.value = '';
            hidden.value = '';
            syncCreateUnitValueThresholdChip('');
            refreshCreateUnitValueState('');
            display.focus();
        });
    };

    window.addEventListener('show-edit-property-modal', () => {
        showModal('edit_property');
        syncEditUnitValueDisplay();
    });

    window.addEventListener('hide-edit-property-modal', () => {
        hideModal('edit_property');
    });

    window.addEventListener('show-delete-property-modal', () => {
        showModal('deletePropertyModal');
    });

    window.addEventListener('hide-delete-property-modal', () => {
        hideModal('deletePropertyModal');
    });

    window.addEventListener('hide-create-property-modal', () => {
        hideModal('create_property_modal');
    });

    window.addEventListener('clearCurrencyDisplay', () => {
        const display = document.getElementById('createUnitValueDisplay');
        const hidden = document.getElementById('createUnitValueHidden');
        if (!display || !hidden) {
            return;
        }

        display.value = '';
        hidden.value = '';
        syncCreateUnitValueThresholdChip('');
        hidden.dispatchEvent(new Event('input', { bubbles: true }));
    });

    window.addEventListener('filters-modal-opened', initTooltips);
    window.addEventListener('filters-applied', initTooltips);
    window.addEventListener('filters-cleared', initTooltips);
    window.addEventListener('filters-applied', () => {
        hideModal('filterModal');
    });
    window.addEventListener('ims-keep-article-modal-open', (event) => {
        const pendingState = {
            tab: event.detail?.tab || 'add_article_tab',
            expiresAt: Date.now() + 1800,
        };

        window.__imsArticleModalPendingState = pendingState;
        window.__imsArticleModalSuppressHiddenResetUntil = pendingState.expiresAt;

        requestAnimationFrame(() => {
            showModal('article_modal');
            if (pendingState.tab) {
                showArticleTab(pendingState.tab);
            }
        });

        window.setTimeout(() => {
            if (window.__imsArticleModalPendingState === pendingState) {
                window.__imsArticleModalPendingState = null;
            }
        }, 2000);
    });

    window.addEventListener('ims-focus-article-create-input', () => {
        const articleInput = document.getElementById('imsNewArticleName');
        if (!articleInput) {
            return;
        }
        requestAnimationFrame(() => articleInput.focus());
    });

    window.addEventListener('ims-focus-description-input', () => {
        const descriptionInput = document.getElementById('newArticleDescriptionInput');
        if (!descriptionInput) {
            return;
        }
        requestAnimationFrame(() => descriptionInput.focus());
    });

    window.addEventListener('ims-focus-remark-create-input', () => {
        const remarkInput = document.querySelector('#article_modal input[wire\:model\.defer="new_remark_name"]');
        if (!remarkInput) {
            return;
        }
        requestAnimationFrame(() => remarkInput.focus());
    });

    window.addEventListener('ims-focus-article-edit-input', () => {
        const editInput = document.querySelector('input[wire\:model\.defer="editingArticleName"]');
        if (!editInput) {
            return;
        }
        requestAnimationFrame(() => editInput.focus());
    });

    window.addEventListener('ims-focus-description-edit-input', () => {
        const editInput = document.querySelector('input[wire\\:model\\.defer="editingDescriptionText"]');
        if (!editInput) {
            return;
        }
        requestAnimationFrame(() => editInput.focus());
    });

    window.addEventListener('ims-focus-remark-edit-input', () => {
        const editInput = document.querySelector('input[wire\\:model\\.defer="editingRemarkName"]');
        if (!editInput) {
            return;
        }
        requestAnimationFrame(() => editInput.focus());
    });

    
    const resetEditPropertyModalScroll = () => {
        const editModal = document.getElementById('edit_property');
        if (!editModal) {
            return;
        }

        editModal.querySelectorAll('.modal-body, .modal-content, .modal-dialog').forEach((node) => {
            node.scrollTop = 0;
        });
    };

    const bindEditPropertyModalHandlers = () => {
        if (window.__imsEditPropertyModalHandlersBound) {
            return;
        }
        window.__imsEditPropertyModalHandlersBound = true;

        const editModal = document.getElementById('edit_property');
        if (!editModal) {
            return;
        }

        editModal.addEventListener('shown.bs.modal', () => {
            resetEditPropertyModalScroll();

            const firstField = editModal.querySelector('select[wire\\:model="edit_office"], select[wire\\:model\\.defer="edit_office"], input[wire\\:model="edit_date_acquired"]');
            if (firstField && typeof firstField.focus === 'function') {
                requestAnimationFrame(() => firstField.focus());
            }
        });

        editModal.addEventListener('hidden.bs.modal', () => {
            resetEditPropertyModalScroll();
        });
    };
        const bindArticleModalHandlers = () => {
        if (window.__imsArticleModalHandlersBound) {
            return;
        }
        window.__imsArticleModalHandlersBound = true;

        document.addEventListener('submit', (event) => {
            const form = event.target.closest('#article_modal form[wire\:submit\.prevent="addNewArticle"]');
            if (!form) {
                return;
            }

            const pendingState = {
                tab: 'add_article_tab',
                expiresAt: Date.now() + 1800,
            };

            window.__imsArticleModalPendingState = pendingState;
            window.__imsArticleModalSuppressHiddenResetUntil = pendingState.expiresAt;

            window.setTimeout(() => {
                if (window.__imsArticleModalPendingState === pendingState) {
                    window.__imsArticleModalPendingState = null;
                }
            }, 2000);
        });
        document.addEventListener('click', (event) => {
            const rowActionButton = event.target.closest('#article_modal [data-ims-article-row-action]');
            if (!rowActionButton) {
                return;
            }

            const pendingState = {
                tab: 'add_article_tab',
                expiresAt: Date.now() + 1800,
            };

            window.__imsArticleModalPendingState = pendingState;
            window.__imsArticleModalSuppressHiddenResetUntil = pendingState.expiresAt;

            window.setTimeout(() => {
                if (window.__imsArticleModalPendingState === pendingState) {
                    window.__imsArticleModalPendingState = null;
                }
            }, 2000);
        });
        document.addEventListener('hidden.bs.modal', (event) => {
            if (event.target?.id !== 'article_modal') {
                return;
            }

            const suppressUntil = window.__imsArticleModalSuppressHiddenResetUntil || 0;
            if (Date.now() < suppressUntil) {
                return;
            }

            window.__imsArticleModalPendingState = null;

            const livewire = getLivewireApi();
            if (livewire?.emit) {
                livewire.emit('articleModalClosed');
            }
            showArticleTab('add_article_tab');
        });

        document.addEventListener('shown.bs.modal', (event) => {
            if (event.target?.id !== 'article_modal') {
                return;
            }

            window.__imsArticleModalSuppressHiddenResetUntil = 0;

            const articleNameInput = document.getElementById('imsNewArticleName');
            if (!articleNameInput) {
                return;
            }
            requestAnimationFrame(() => articleNameInput.focus());
        });
    };
    const resetCreatePropertyModalScroll = () => {
        const createModal = document.getElementById('create_property_modal');
        if (!createModal) {
            return;
        }

        createModal.querySelectorAll('.modal-body, .modal-content, .modal-dialog').forEach((node) => {
            node.scrollTop = 0;
        });
    };

    const bindCreatePropertyModalHandlers = () => {
        if (window.__imsCreatePropertyModalHandlersBound) {
            return;
        }
        window.__imsCreatePropertyModalHandlersBound = true;

        const createModal = document.getElementById('create_property_modal');
        if (!createModal) {
            return;
        }

        createModal.addEventListener('shown.bs.modal', () => {
            resetCreatePropertyModalScroll();

            const firstField = createModal.querySelector('select[wire\\:model="SelectedOffice"], select[wire\\:model\\.defer="SelectedOffice"]');
            if (firstField && typeof firstField.focus === 'function') {
                requestAnimationFrame(() => firstField.focus());
            }
        });

        createModal.addEventListener('hidden.bs.modal', () => {
            resetCreatePropertyModalScroll();

            const livewire = getLivewireApi();
            if (livewire?.emitTo) {
                livewire.emitTo('admin.inventory-management.components.property.index', 'resetModalForm');
            }
        });
    };
    const escapeHtml = (value) => (value || '').toString()
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#39;');

    const getPrintFilterSummary = () => {
        const filterChips = Array.from(document.querySelectorAll('.ims-filter-chip'));
        if (!filterChips.length) {
            return '';
        }

        const items = filterChips.map((chip) => {
            const label = chip.querySelector('.ims-filter-chip-label')?.textContent?.trim() || 'Filter';
            const value = chip.querySelector('.ims-filter-chip-value')?.textContent?.trim() || 'N/A';
            return `<li><strong>${escapeHtml(label)}:</strong> ${escapeHtml(value)}</li>`;
        }).join('');

        return `
            <section class="ims-print-filters">
                <h2>Active Filters</h2>
                <ul>${items}</ul>
            </section>
        `;
    };

    const buildPrintTableHtml = () => {
        const sourceTable = document.getElementById('imsCurrentTable') || document.querySelector('.inventory-table');
        if (!sourceTable) {
            return '';
        }

        const clonedTable = sourceTable.cloneNode(true);
        clonedTable.querySelectorAll('.ims-action-col, .ims-action-cell').forEach((node) => node.remove());
        clonedTable.querySelectorAll('.specification-cell').forEach((cell) => {
            const textNode = cell.querySelector('.specification-cell-text');
            const fullText = textNode?.getAttribute('title') || textNode?.textContent || cell.textContent || 'N/A';
            cell.innerHTML = `<span>${escapeHtml(fullText.trim() || 'N/A')}</span>`;
        });

        return clonedTable.outerHTML;
    };

    const printCurrentInventoryPage = () => {
        const tableHtml = buildPrintTableHtml();
        if (!tableHtml) {
            return;
        }

        const activePage = document.querySelector('.ims-table-footer .page-item.active .page-link')?.textContent?.trim() || '1';
        const printWindow = window.open('', '_blank', 'noopener,noreferrer');
        if (!printWindow) {
            return;
        }

        const printedAt = new Date().toLocaleString();
        const filterSummary = getPrintFilterSummary();

        printWindow.document.open();
        printWindow.document.write(`
            <!doctype html>
            <html lang="en">
            <head>
                <meta charset="utf-8">
                <title>IMS Current Page Print</title>
                <style>
                    :root { color-scheme: light; }
                    body { font-family: Arial, sans-serif; margin: 24px; color: #0f172a; }
                    .ims-print-head { margin-bottom: 18px; }
                    .ims-print-head h1 { margin: 0 0 6px; font-size: 22px; }
                    .ims-print-head p { margin: 2px 0; font-size: 12px; color: #475569; }
                    .ims-print-filters { margin: 0 0 18px; padding: 12px 14px; border: 1px solid #dbe4ee; border-radius: 10px; background: #f8fafc; }
                    .ims-print-filters h2 { margin: 0 0 8px; font-size: 13px; }
                    .ims-print-filters ul { margin: 0; padding-left: 18px; }
                    .ims-print-filters li { font-size: 12px; margin-bottom: 4px; }
                    table { width: 100%; border-collapse: collapse; table-layout: auto; }
                    thead th { background: #eff6ff; color: #1e3a8a; font-size: 11px; text-transform: uppercase; letter-spacing: .04em; }
                    th, td { border: 1px solid #dbe4ee; padding: 8px 10px; vertical-align: top; font-size: 11px; }
                    tbody tr:nth-child(even) td { background: #f8fafc; }
                    .badge { display: inline-block; padding: 2px 8px; border-radius: 999px; background: #e2e8f0; }
                    .currency-inline { white-space: nowrap; }
                    @media print {
                        body { margin: 12mm; }
                    }
                </style>
            </head>
            <body>
                <header class="ims-print-head">
                    <h1>Inventory Management System</h1>
                    <p>Current Visible Table Page</p>
                    <p>Page ${escapeHtml(activePage)} &bull; Printed ${escapeHtml(printedAt)}</p>
                </header>
                ${filterSummary}
                ${tableHtml}
            </body>
            </html>
        `);
        printWindow.document.close();

        printWindow.onload = () => {
            printWindow.focus();
            printWindow.print();
            printWindow.close();
        };
    };

    const bindPrintCurrentPageHandler = () => {
        if (window.__imsPrintCurrentPageHandlerBound) {
            return;
        }
        window.__imsPrintCurrentPageHandlerBound = true;

        document.addEventListener('click', (event) => {
            const trigger = event.target.closest('.js-ims-print-current-page');
            if (!trigger) {
                return;
            }

            event.preventDefault();
            printCurrentInventoryPage();
        });
    };
    const onLivewireLoad = () => {
        initTooltips();
        syncEditUnitValueDisplay();
        syncCreateUnitValueDisplay();
        bindEditUnitValueHandlers();
        bindCreateUnitValueHandlers();
        bindFilterModalHandlers();
        bindSpecificationToggleHandlers();
        bindArticleModalHandlers();
        bindPrintCurrentPageHandler();
        bindEditPropertyModalHandlers();
        bindCreatePropertyModalHandlers();

        const livewire = getLivewireApi();
        if (livewire?.hook && !window.__imsLivewireHookBound) {
            window.__imsLivewireHookBound = true;
            livewire.hook('message.processed', () => {
                initTooltips();
                syncCreateUnitValueDisplay();
                routeArticleTabByValidation();
                focusFirstInvalidArticleField();

                const pendingArticleModalState = window.__imsArticleModalPendingState;
                if (pendingArticleModalState && pendingArticleModalState.expiresAt > Date.now()) {
                    window.__imsArticleModalSuppressHiddenResetUntil = pendingArticleModalState.expiresAt;
                    showModal('article_modal');
                    if (pendingArticleModalState.tab) {
                        requestAnimationFrame(() => showArticleTab(pendingArticleModalState.tab));
                    }
                }
            });
        }
    };

    document.addEventListener('livewire:load', onLivewireLoad);
    onLivewireLoad();
})();
</script>




