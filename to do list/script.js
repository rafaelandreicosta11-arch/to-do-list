// Função para mostrar mensagens no topo
function showMessage(msg, type = "success") {
  const messageBox = document.createElement("div");
  messageBox.textContent = msg;
  messageBox.className = `message ${type}`;
  document.body.appendChild(messageBox);

  setTimeout(() => {
    messageBox.classList.add("show");
  }, 50);

  setTimeout(() => {
    messageBox.classList.remove("show");
    setTimeout(() => messageBox.remove(), 300);
  }, 2500);
}

// Excluir tarefa via AJAX
function excluirTarefa(id) {
  if (confirm("Deseja realmente excluir esta tarefa?")) {
    fetch(`home.php?delete=${id}`, { method: "GET" })
      .then(() => {
        const card = document.querySelector(`#task-${id}`);
        if (card) {
          card.classList.add("fade-out");
          setTimeout(() => card.remove(), 300);
        }
        showMessage("Tarefa excluída com sucesso!");
      })
      .catch(() => showMessage("Erro ao excluir tarefa!", "error"));
  }
}

// Adicionar tarefa via AJAX
document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector("#formAdd");
  if (form) {
    form.addEventListener("submit", (e) => {
      e.preventDefault();
      const titulo = form.titulo.value.trim();
      if (titulo === "") return showMessage("Digite um título!", "error");

      fetch("home.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `titulo=${encodeURIComponent(titulo)}`,
      })
        .then(() => {
          const list = document.querySelector("#listaTarefas");
          const newCard = document.createElement("div");
          newCard.className = "task-card";
          newCard.id = "temp";
          newCard.innerHTML = `
            <span class="task-title">${titulo}</span>
            <div class="actions">
              <a href="#" onclick="showMessage('Atualize a página para editar.'); return false;">Editar</a>
              <a href="#" onclick="document.querySelector('#temp').remove(); showMessage('Tarefa adicionada!'); return false;">Excluir</a>
            </div>
          `;
          list.prepend(newCard);
          form.reset();
          showMessage("Tarefa adicionada com sucesso!");
        })
        .catch(() => showMessage("Erro ao adicionar tarefa!", "error"));
    });
  }
});
