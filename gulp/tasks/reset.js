import del from "del";
//======npm install del@6
export const reset = () => {
  return del(app.path.clean);
}