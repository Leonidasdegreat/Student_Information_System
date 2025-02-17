<div class="modal fade" id="addEnrollmentModal" tabindex="-1" aria-labelledby="addEnrollmentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEnrollmentModalLabel">Add Enrollment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('enrollments.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="student_id" class="form-label">Search Student</label>
                        <select class="form-select select2" id="student_id" name="student_id" required>
                            <option value="">Search and select a student...</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}">{{ $student->id }} - {{ $student->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="subject_id" class="form-label">Search Subject</label>
                        <select class="form-select select2" id="subject_id" name="subject_id" required>
                            <option value="">Search and select a subject...</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->id }} - {{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="enrollment_date" class="form-label">Enrollment Date</label>
                        <input type="date" class="form-control" name="enrollment_date" required>
                    </div>

                    <button type="submit" class="btn btn-success">Add Enrollment</button>
                </form>
            </div>
        </div>
    </div>
</div>
