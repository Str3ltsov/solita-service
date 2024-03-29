<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="verify-paysera" content="d8faf87eb99ea978aac839fd18775dc2">
    <!-- Title -->
    <title>{{ config('app.name', 'Solita Service') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('datatables/media/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.5.1/nouislider.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset("vendor/cookie-consent/css/cookie-consent.css") }}">
    @stack('css')
    @livewireStyles
</head>
<body>
<div class="@auth @if (Auth::user()->type != 4) admin-view @endif @endauth">
    @auth
        @if (Auth::user()->type != 4)
            @include('layouts.headers.staff_header')
        @else
            @include('layouts.headers.header')
        @endif
    @endauth
    @guest
        @include('layouts.headers.header')
    @endguest
    <main class="main shop">
        @yield('content')
        <button type="button" class="scroll-to-top-button">
            <i class="fa-solid fa-angle-up"></i>
        </button>
    </main>
    @include('layouts.footer')
</div>
<script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('js/bootstrap.bundle.js')}}"></script>
<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/jquery-ui.js')}}"></script>
{{--<script src="{{ asset('js/app.js') }}"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.5.1/nouislider.min.js"></script>
<script>
    $(document).ready(function () {
        $('#categories').DataTable(
            {
                "language":
                    {
                        "emptyTable": "No data available in table",
                        "info": "{{__("names.showing")}} _START_ {{__("names.to")}} _END_ {{__("names.of")}} _TOTAL_ {{__("names.entries")}}",
                        "infoEmpty": "{{__("names.showing")}}  0 {{__("names.to")}} 0 {{__("names.of")}} 0 {{__("names.entries")}}",
                        "infoFiltered": "(filtered from _MAX_ total entries)",
                        "infoThousands": ",",
                        "lengthMenu": "{{__("names.showing")}} _MENU_ {{__("names.entries")}}",
                        "loadingRecords": "Loading...",
                        "processing": "Processing...",
                        "search": "{{__("names.search")}}:",
                        "zeroRecords": "{{__("names.zeroRecords")}}:",
                        "thousands": ",",
                        "paginate": {
                            "first": "{{__("names.first")}}",
                            "previous": "&laquo;&nbsp;{{__("pagination.previous")}}",
                            "next": "{{__("pagination.next") }}&nbsp;&raquo;",
                            "last": "{{__("names.last")}}"
                        },
                        "aria": {
                            "sortAscending": ": activate to sort column ascending",
                            "sortDescending": ": activate to sort column descending"
                        },
                        "autoFill": {
                            "cancel": "Cancel",
                            "fill": "Fill all cells with <i>%d<\/i>",
                            "fillHorizontal": "Fill cells horizontally",
                            "fillVertical": "Fill cells vertically"
                        },
                        "buttons": {
                            "collection": "Collection <span class='ui-button-icon-primary ui-icon ui-icon-triangle-1-s'\/>",
                            "colvis": "Column Visibility",
                            "colvisRestore": "Restore visibility",
                            "copy": "Copy",
                            "copyKeys": "Press ctrl or u2318 + C to copy the table data to your system clipboard.<br><br>To cancel, click this message or press escape.",
                            "copySuccess": {
                                "1": "Copied 1 row to clipboard",
                                "_": "Copied %d rows to clipboard"
                            },
                            "copyTitle": "Copy to Clipboard",
                            "csv": "CSV",
                            "excel": "Excel",
                            "pageLength": {
                                "-1": "Show all rows",
                                "_": "Show %d rows"
                            },
                            "pdf": "PDF",
                            "print": "Print",
                            "updateState": "Update",
                            "stateRestore": "State %d",
                            "savedStates": "Saved States",
                            "renameState": "Rename",
                            "removeState": "Remove",
                            "removeAllStates": "Remove All States",
                            "createState": "Create State"
                        },
                        "searchBuilder": {
                            "add": "Add Condition",
                            "button": {
                                "0": "Search Builder",
                                "_": "Search Builder (%d)"
                            },
                            "clearAll": "Clear All",
                            "condition": "Condition",
                            "conditions": {
                                "date": {
                                    "after": "After",
                                    "before": "Before",
                                    "between": "Between",
                                    "empty": "Empty",
                                    "equals": "Equals",
                                    "not": "Not",
                                    "notBetween": "Not Between",
                                    "notEmpty": "Not Empty"
                                },
                                "number": {
                                    "between": "Between",
                                    "empty": "Empty",
                                    "equals": "Equals",
                                    "gt": "Greater Than",
                                    "gte": "Greater Than Equal To",
                                    "lt": "Less Than",
                                    "lte": "Less Than Equal To",
                                    "not": "Not",
                                    "notBetween": "Not Between",
                                    "notEmpty": "Not Empty"
                                },
                                "string": {
                                    "contains": "Contains",
                                    "empty": "Empty",
                                    "endsWith": "Ends With",
                                    "equals": "Equals",
                                    "not": "Not",
                                    "notEmpty": "Not Empty",
                                    "startsWith": "Starts With",
                                    "notContains": "Does Not Contain",
                                    "notStarts": "Does Not Start With",
                                    "notEnds": "Does Not End With"
                                },
                                "array": {
                                    "without": "Without",
                                    "notEmpty": "Not Empty",
                                    "not": "Not",
                                    "contains": "Contains",
                                    "empty": "Empty",
                                    "equals": "Equals"
                                }
                            },
                            "data": "Data",
                            "deleteTitle": "Delete filtering rule",
                            "leftTitle": "Outdent Criteria",
                            "logicAnd": "And",
                            "logicOr": "Or",
                            "rightTitle": "Indent Criteria",
                            "title": {
                                "0": "Search Builder",
                                "_": "Search Builder (%d)"
                            },
                            "value": "Value"
                        },
                        "searchPanes": {
                            "clearMessage": "Clear All",
                            "collapse": {
                                "0": "SearchPanes",
                                "_": "SearchPanes (%d)"
                            },
                            "count": "{total}",
                            "countFiltered": "{shown} ({total})",
                            "emptyPanes": "No SearchPanes",
                            "loadMessage": "Loading SearchPanes",
                            "title": "Filters Active - %d",
                            "showMessage": "Show All",
                            "collapseMessage": "Collapse All"
                        },
                        "select": {
                            "cells": {
                                "1": "1 cell selected",
                                "_": "%d cells selected"
                            },
                            "columns": {
                                "1": "1 column selected",
                                "_": "%d columns selected"
                            }
                        },
                        "datetime": {
                            "previous": "Previous",
                            "next": "Next",
                            "hours": "Hour",
                            "minutes": "Minute",
                            "seconds": "Second",
                            "unknown": "-",
                            "amPm": [
                                "am",
                                "pm"
                            ],
                            "weekdays": [
                                "Sun",
                                "Mon",
                                "Tue",
                                "Wed",
                                "Thu",
                                "Fri",
                                "Sat"
                            ],
                            "months": [
                                "January",
                                "February",
                                "March",
                                "April",
                                "May",
                                "June",
                                "July",
                                "August",
                                "September",
                                "October",
                                "November",
                                "December"
                            ]
                        },
                        "editor": {
                            "close": "Close",
                            "create": {
                                "button": "New",
                                "title": "Create new entry",
                                "submit": "Create"
                            },
                            "edit": {
                                "button": "Edit",
                                "title": "Edit Entry",
                                "submit": "Update"
                            },
                            "remove": {
                                "button": "Delete",
                                "title": "Delete",
                                "submit": "Delete",
                                "confirm": {
                                    "_": "Are you sure you wish to delete %d rows?",
                                    "1": "Are you sure you wish to delete 1 row?"
                                }
                            },
                            "error": {
                                "system": "A system error has occurred (<a target=\"\\\" rel=\"nofollow\" href=\"\\\">More information<\/a>)."
                            },
                            "multi": {
                                "title": "Multiple Values",
                                "info": "The selected items contain different values for this input. To edit and set all items for this input to the same value, click or tap here, otherwise they will retain their individual values.",
                                "restore": "Undo Changes",
                                "noMulti": "This input can be edited individually, but not part of a group. "
                            }
                        },
                        "stateRestore": {
                            "renameTitle": "Rename State",
                            "renameLabel": "New Name for %s:",
                            "renameButton": "Rename",
                            "removeTitle": "Remove State",
                            "removeSubmit": "Remove",
                            "removeJoiner": " and ",
                            "removeError": "Failed to remove state.",
                            "removeConfirm": "Are you sure you want to remove %s?",
                            "emptyStates": "No saved states",
                            "emptyError": "Name cannot be empty.",
                            "duplicateError": "A state with this name already exists.",
                            "creationModal": {
                                "toggleLabel": "Includes:",
                                "title": "Create New State",
                                "select": "Select",
                                "searchBuilder": "SearchBuilder",
                                "search": "Search",
                                "scroller": "Scroll Position",
                                "paging": "Paging",
                                "order": "Sorting",
                                "name": "Name:",
                                "columns": {
                                    "visible": "Column Visibility",
                                    "search": "Column Search"
                                },
                                "button": "Create"
                            }
                        }
                    }
            }
        );
    });

    $(function () {
        $("#start").datepicker();
    });

    $(function () {
        $("#finish").datepicker();
    });

    /*
     * Scroll to top button functionality
     */
    const scrollToTopButton = document.querySelector('.scroll-to-top-button');
    const topbarHeight = 42;

    scrollToTopButton.addEventListener('click', () => window.scrollTo(0, 0));

    window.addEventListener('scroll', () => {
        scrollToTopButton.classList.toggle('show', window.scrollY > topbarHeight);

        if (document.body.scrollTop > topbarHeight || document.documentElement.scrollTop > topbarHeight)
            scrollToTopButton.classList.add('fade-in');
    });

    /*
     * Specialist selectors functionality
     */
    const specialistNumberWrappers = document.querySelectorAll('.specialist-hours-wrapper');

    specialistNumberWrappers.forEach(specialistNumberWrapper => {
        specialistNumberWrapper.classList.add('d-none')
    });

    let specialistsCheckboxes = document.querySelectorAll('.specialist-checkbox');
    let specialistsNumbers = document.querySelectorAll('.specialist-number');

    const setSpecialistsIds = () => {
        let specialistsIds = ''

        for (let i = 0; i < specialistsCheckboxes.length; i++) {
            if (specialistsCheckboxes[i].checked && specialistsIds)
                specialistsIds = specialistsIds.concat(',')

            if (specialistsCheckboxes[i].checked) {
                specialistsIds = specialistsIds.concat(specialistsCheckboxes[i].value)
                specialistNumberWrappers[i].classList.remove('d-none')
            }
            else
                specialistNumberWrappers[i].classList.add('d-none')
        }

        document.getElementById('specialistsIds').value = specialistsIds
    }

    const setSpecialistHours = () => {
        let specialistsHours = ''

        for (let i = 0; i < specialistsNumbers.length; i++) {
            if (specialistsHours)
                specialistsHours = specialistsHours.concat(',')

            specialistsHours = specialistsHours.concat(specialistsNumbers[i].value)
        }

        document.getElementById('specialistsHours').value = specialistsHours
    }
</script>
@stack('scripts')
@livewireScripts
</body>
</html>
