const getFollowingRow = mouseY => {
    const allRows = [...document.querySelectorAll('.draggable')];

    const initialValue = {element: null, offset: Number.NEGATIVE_INFINITY};

    const nextRow = allRows.reduce((closestBoundary, row) => {
        const rowArea = row.getBoundingClientRect();
        let offset = mouseY - rowArea.top - (rowArea.height / 2);

        return offset < 0 && offset > closestBoundary.offset ? {element: row, offset: offset} : closestBoundary;
    }, initialValue);

    return nextRow.element;
};

const rearrangeOrder = async (id, order) => {
    const apiUri = 'http://127.0.0.1:8000/admin/projects/' + id;

    try{
        await axios.patch(apiUri, {order});
        console.log('Item successfully moved');
    } catch (err) {
        console.error(err);
    }
};

const tableBody = document.querySelector('tbody');
const draggableRows = document.querySelectorAll('.draggable');

let draggedRow = null;

draggableRows.forEach(row => {
    row.addEventListener('dragstart', () => {
        row.classList.add('dragging');
        draggedRow = row;
    } );
    
    row.addEventListener('dragend', () => {
        row.classList.remove('dragging');

        const startPosition = row.dataset.position;
        
        document.querySelectorAll('.draggable').forEach((r, i) => {
            r.dataset.position = i + 1;
        });
        
        const endPosition = row.dataset.position;

        if (startPosition !== endPosition) {
            console.log(`Row with id ${row.dataset.id} moved from position: ${startPosition}' to position: '${endPosition}'`);
            rearrangeOrder(row.dataset.id, endPosition);
        }
        
        draggedRow = null;
    } );
});

tableBody.addEventListener('dragover', event => {
    event.preventDefault();

    const nextRow = getFollowingRow(event.clientY);

    if (nextRow === null) {
        tableBody.appendChild(draggedRow);
    } else {
        tableBody.insertBefore(draggedRow, nextRow);
    }
});
