<?php 
    //Adds a new song to the current user's playlist and returns a serialized updated user.
    function add_song_to_library($song, $user) {
        //Unserialize user library and add song into user's library array.
        $library = unserialize($user->get_library());
        $library[$song->get_name()] = serialize($song);
        //Serialize the library after song has been added and update the user's library.
        $updated_library = serialize($library);
        $user->set_library($updated_library);
        //Serialize the user and return it.
        $serialized_user = serialize($user);
        return $serialized_user;
    }
    //Removes a 'Song' from a 'User' library and updates that library.
    function remove_song_from_library($song,$user) {
        //Unserialize user library and remove song from it.
        $library = unserialize($user->get_library());
        unset($library[$song]);
        //Serialize library and set it as an updated library for the user.
        $removed_from = serialize($library);
        $user->set_library($removed_from);
        //Serialize the user and return it.
        $serialized_user = serialize($user);
        return $serialized_user;
    }
    //Sets an 'annotation' to a 'Song' in a 'User' library.
    function annotate_song($song, $user, $annotation) {
        //Unserialize user library and unserialize a song from that library.
       $library = unserialize($user->get_library());
       $to_annotate = unserialize($library[$song]);
       //Set the song's annotation to be the $annotation variable then serialize the song again and place back in the library
       $to_annotate->set_annotation($annotation);
       $library[$song] = serialize($to_annotate);
       //Serialize the updated library and set it back to the user library.
       $annotated_library = serialize($library);
       $user->set_library($annotated_library);
       //Serialize the user and return it.
       $serialized_user = serialize($user);
       return $serialized_user;
    }
?>