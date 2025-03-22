<div class="modal fade" id="addEnrollmentModal" tabindex="-1" aria-labelledby="addEnrollmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow-lg border-0 rounded-3">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title fw-bold" id="addEnrollmentModalLabel">Add Enrollment</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form action="{{ route('enrollments.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="student_id" class="form-label fw-semibold">Search Student</label>
                            <select class="form-select select2" id="student_id" name="student_id" required>
                                <option value="">Select a student...</option>
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->id }} - {{ $student->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="subject_id" class="form-label fw-semibold">Search Subject</label>
                            <select class="form-select select2" id="subject_id" name="subject_id" required>
                                <option value="">Select a subject...</option>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->id }} - {{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="enrollment_date" class="form-label fw-semibold">Enrollment Date</label>
                            <input type="date" class="form-control" name="enrollment_date" required>
                        </div>

                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-success px-4">Add Enrollment</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Include Select2 if not already included -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            width: '100%',
            placeholder: "Search...",
            allowClear: true
        });
    });
</script>
