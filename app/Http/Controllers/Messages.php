<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Messages extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //Inbox
    {
        $mails = DB::select('SELECT m.*, u.id AS uid, u.name, u.lastname FROM messages m INNER JOIN users u ON (m.sender = u.id) WHERE m.recipient = ? AND m.state = ?', [Auth::user()->id, 'inbox']);
        return view('mailbox.index')->with([
            'mails' => $mails
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('mailbox.create')->with(['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request);
        $this->validate($request, [
            'destinatario' => 'required',
            'asunto' => 'required',
            'etiqueta' => 'required',
            'mensaje' => 'required'
        ]);

        $message = new Message();
        $message->sender = Auth::user()->id;
        $message->recipient = $request->destinatario;
        $message->subject = $request->asunto;
        $message->label = $request->etiqueta;
        $message->message = $request->mensaje;
        $message->datetime = date('Y-m-d h:i:s');
        $message->state = $request->mail_state;
        $message->opened = false;
        if ($message->save()) {
            if ($request->mail_state == 'inbox') {
                return redirect()->action('Messages@index')->with(['msj' => 'Mensaje enviado con éxito.']);
            } else {
                return redirect()->action('Messages@index')->with(['msj' => 'Mensaje archivado con éxito.']);
            }
        } else {
            return redirect()->action('Messages@index')->with(['errorMsj' => 'Error al enviar los datos.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (is_numeric($id)) {
            if ($msg = Message::find($id)) {
                $message = DB::select('SELECT m.*, r.id AS rid, r.name AS rname, r.lastname AS rlastname, r.email AS remail, s.id AS sid, s.name AS sname, s.lastname AS slastname, s.email AS semail FROM messages m INNER JOIN users r ON (m.recipient = r.id) INNER JOIN users s ON (s.id = m.sender) WHERE m.id = ? LIMIT 1', [$id]);
                $isMine = null;
                if ($message[0]->recipient == Auth::user()->id) {
                    $isMine = false;
                    $msg->opened = true;
                    $msg->save();
                } else {
                    $isMine = true;
                }
                return view('mailbox.read')->with([
                    'message' => $message[0],
                    'isMine' => $isMine
                ]);
            } else {
                return redirect()->isNotFound();
            }
        } else {
            switch ($id) {
                case 'sent':
                    $sent = DB::select('SELECT m.*, u.id AS uid, u.name, u.lastname FROM messages m INNER JOIN users u ON (u.id = m.recipient) WHERE m.sender = ?', [Auth::user()->id]);
                    return view('mailbox.sent')->with([
                        'mails' => $sent
                    ]);
                    break;
                case 'drafts':
                    $drafts = DB::select('SELECT m.*, u.id AS uid, u.name, u.lastname FROM messages m INNER JOIN users u ON (m.recipient = u.id) WHERE m.sender = ? AND m.state = ?', [Auth::user()->id, 'drafts']);
                    return view('mailbox.drafts')->with([
                        'mails' => $drafts
                    ]);
                    break;
                default :
                    return redirect()->isNotFound();
                    break;
            }
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::all();
        $message = DB::select('SELECT m.*, u.id AS uid, u.name, u.lastname FROM messages m INNER JOIN users u ON (m.recipient = u.id) WHERE m.id = ?', [$id]);
        if (Message::find($id)) {
            if ($message[0]->state == 'drafts') {
                return view('mailbox.edit')->with([
                    'message' => $message[0],
                    'users' => $users
                ]);
            } else {
                return redirect()->action('HomeController@index');
            }
        } else {
            return redirect()->action('HomeController@index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//        dd($request);
        $this->validate($request, [
            'destinatario' => 'required',
            'asunto' => 'required',
            'etiqueta' => 'required',
            'mensaje' => 'required'
        ]);

        $message = Message::find($id);
        $message->recipient = $request->destinatario;
        $message->subject = $request->asunto;
        $message->label = $request->etiqueta;
        $message->message = $request->mensaje;
        $message->datetime = date('Y-m-d h:i:s');
        $message->state = $request->mail_state;
        if ($message->save()) {
            if ($request->mail_state == 'inbox') {
                return redirect()->action('Messages@index')->with(['msj' => 'Mensaje enviado con éxito.']);
            } else {
                return redirect()->action('Messages@index')->with(['msj' => 'Mensaje archivado con éxito.']);
            }
        } else {
            return redirect()->action('Messages@index')->with(['errorMsj' => 'Error al enviar los datos.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //Custom functions

    public function moveToTrash(Request $request, $id)
    {
//        return $id . ' ' . $location;
        $message = Message::find($id);
        $message->state = 'trash';
        if ($message->save()) {
            return redirect()->route('mailbox.index')->with(['msj' => 'Mensaje eliminado con éxito.']);
        } else {
            return redirect()->action('Messages@index')->with(['errorMsj' => 'Error al enviar los datos.']);
        }
    }

    public static function getMailsCount()
    {
        $mail = DB::select('SELECT count(*) AS count FROM messages m WHERE m.recipient = ? AND m.opened = ? AND m.state = ?', [Auth::user()->id, FALSE, 'inbox']);
        return $mail[0]->count;
    }

    public static function getImportantMCount()
    {
        $mail = DB::select('SELECT count(m.label) AS count FROM messages m WHERE m.recipient = ? AND m.label = ? AND m.opened = ? AND m.state = ?', [Auth::user()->id, 'Importante', FALSE, 'inbox']);
        return $mail[0]->count;
    }

    public static function getWarningMCount()
    {
        $mail = DB::select('SELECT count(m.label) AS count FROM messages m WHERE m.recipient = ? AND m.label = ? AND m.opened = ? AND m.state = ?', [Auth::user()->id, 'Advertencia', FALSE, 'inbox']);
        return $mail[0]->count;
    }

    public static function getInfoMCount()
    {
        $mail = DB::select('SELECT count(m.label) AS count FROM messages m WHERE m.recipient = ? AND m.label = ? AND m.opened = ? AND m.state = ?', [Auth::user()->id, 'Informacion', FALSE, 'inbox']);
        return $mail[0]->count;
    }

    public static function getMails($limit = 0)
    {
        $mails = DB::select('SELECT m.*, u.id AS uid, u.name, u.lastname, u.img_url FROM messages m INNER JOIN users u ON (m.sender = u.id) WHERE m.recipient = ? AND m.opened = ? AND m.state = ? ORDER BY m.datetime ASC LIMIT ?', [Auth::user()->id, FALSE, 'inbox', $limit]);
        return $mails;
    }

    public static function shortText($string, $length = NULL)
    {
        //Si no se especifica la longitud por defecto es 50
        if ($length == NULL)
            $length = 45;
        //Primero eliminamos las etiquetas html y luego cortamos el string
        $stringDisplay = substr(strip_tags($string), 0, $length);
        //Si el texto es mayor que la longitud se agrega puntos suspensivos
        if (strlen(strip_tags($string)) > $length)
            $stringDisplay .= ' ...';
        return $stringDisplay;
    }

}
