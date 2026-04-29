<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3>Modifier une note (Manipulation du DOM)</h3>
    </div>
    <div class="card-body">
        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success" style="padding:1rem;background-color:#d1fae5;color:#0369a1;border-radius:4px;margin-bottom:1rem;">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Étudiant</th>
                    <th>UE</th>
                    <th>Note</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($notes)): ?>
                    <?php foreach($notes as $n): ?>
                        <tr id="row-<?= $n['id'] ?>">
                            <td><?= esc($n['id']) ?></td>
                            <td><?= esc($n['prenom'].' '.$n['nom']) ?></td>
                            <td><?= esc($n['ue_nom']) ?></td>
                            <td class="note-cell"><?= esc($n['note']) ?></td>
                            <td>
                                <button class="btn btn-primary btn-sm" onclick="editNote(<?= $n['id'] ?>, <?= $n['note'] ?>)">Modifier</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5">Aucune note enregistrée.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function editNote(id, currentNote) {
    const row = document.getElementById('row-' + id);
    const noteCell = row.querySelector('.note-cell');
    const actionCell = row.querySelector('td:last-child');
    
    // Render dynamic form input in Note cell
    noteCell.innerHTML = `<input type="number" step="0.01" min="0" max="20" class="form-control" id="input-${id}" value="${currentNote}" style="width:100px;">`;
    
    // Changing action button
    actionCell.innerHTML = `<button class="btn btn-primary btn-sm" style="background:#10b981;border-color:#059669;" onclick="saveNote(${id})">Sauvegarder</button>`;
}

function saveNote(id) {
    const newNote = document.getElementById('input-' + id).value;

    // We can submit dynamically a small hidden form to stay simple and within CI standards
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '<?= base_url('notes/edit') ?>';

    const idInput = document.createElement('input');
    idInput.type = 'hidden';
    idInput.name = 'id';
    idInput.value = id;
    form.appendChild(idInput);

    const noteInput = document.createElement('input');
    noteInput.type = 'hidden';
    noteInput.name = 'note';
    noteInput.value = newNote;
    form.appendChild(noteInput);

    document.body.appendChild(form);
    form.submit();
}
</script>
<?= $this->endSection() ?>
