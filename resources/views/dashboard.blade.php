<x-content>
    <x-slot name="title">
        {{ __('Dashboard') }}
    </x-slot>

    <div class="row p-4">
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card">
                <div class="card-header">Add Task</div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Task Name</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Task name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Estimation Time (Minutes)</label>
                            <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Estimation Time" step="0.1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Deadline</label>
                            <input type="datetime-local" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-check">
                            <input onchange="weightHandle()" type="checkbox" class="form-check-input" id="weightCheck">
                            <label class="form-check-label" for="exampleCheck1">Weight</label>
                        </div>
                        <div id="weight" class="form-row pt-2 mb-4 d-none">
                            <div class="col-4">
                                <select class="form-control" id="exampleInputEmail1">
                                    <option>Budget</option>
                                    <option>SKS</option>
                                </select>
                            </div>
                            <div class="col-8">
                                <input type="number" class="form-control" placeholder="Weight Value" step="0.1">
                            </div>
                        </div>
                        <div class="text-right">
                            <x-primary-button>{{ __('Add') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-header">Your Task</div>
                <div class="card-body">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="script">
        <script>
            let checked = false;
            function weightHandle(){
                const weightVassal = document.getElementById('weight');

                if(!checked){
                    weightVassal.classList.remove('d-none');
                    checked = true;
                }else{
                    weightVassal.classList.add('d-none');
                    checked=false;
                }
            }
        </script>
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
        <script>

            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth'
                });
                calendar.render();
            });

        </script>
    </x-slot>
</x-content>
